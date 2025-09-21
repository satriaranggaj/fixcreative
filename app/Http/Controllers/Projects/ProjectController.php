<?php

namespace App\Http\Controllers\Projects;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['items', 'payments'])->latest()->paginate(10);

        return Inertia::render('Projects/Project/Index', [
            'projects'   => $projects->items(),
            'pagination' => $projects,
        ]);
    }

    public function Invoice(){
        $projects = Project::with(['items', 'payments'])->latest()->paginate(10);

        return Inertia::render('Projects/Invoice/Index', [
            'projects'   => $projects->items(),
            'pagination' => $projects,
        ]);
    }
    
    public function create()
    {
        return Inertia::render('Projects/Project/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client'     => 'required|string|max:255',
            'phone'      => 'required|string|max:50',
            'email'      => 'nullable|email|max:255',
            'venue'      => 'nullable|string|max:255',
            'address'    => 'nullable|string|max:255',
            'description'=> 'nullable|string',
            'event_start' => 'nullable|date',
            'event_end'   => 'nullable|date|after_or_equal:event_start',
            'items'      => 'required|array|min:1',
            'items.*.name'  => 'required|string|max:255',
            'items.*.qty'   => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'payments' => 'nullable|array',
            'payments.*.type' => 'required|in:down_payment,installment,final',
            'payments.*.amount' => 'required|numeric|min:0',
            'payments.*.payment_date' => 'nullable|date',
            'payments.*.method' => 'nullable|string|max:100',
        ]);

        $project = Project::create($validated);

        foreach ($validated['items'] as $item) {
            $project->items()->create($item);
        }

        if (!empty($validated['payments'])) {
            foreach ($validated['payments'] as $payment) {
                $project->payments()->create($payment);
            }
        }

        return redirect()->route('index.projects')->with('message', [
            ["success", "Project created successfully"]
        ]);
    }

    public function edit(Project $project)
    {
        $project->load('items');

        return Inertia::render('Projects/Project/Form', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'client'     => 'required|string|max:255',
            'phone'      => 'required|string|max:50',
            'email'      => 'nullable|email|max:255',
            'venue'      => 'nullable|string|max:255',
            'address'    => 'nullable|string|max:255',
            'description'=> 'nullable|string',
            'event_start' => 'nullable|date',
            'event_end'   => 'nullable|date|after_or_equal:event_start',
            'items'      => 'required|array|min:1',
            'items.*.name'  => 'required|string|max:255',
            'items.*.qty'   => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'payments' => 'nullable|array',
            'payments.*.type' => 'required|in:down_payment,installment,final',
            'payments.*.amount' => 'required|numeric|min:0',
            'payments.*.payment_date' => 'nullable|date',
            'payments.*.method' => 'nullable|string|max:100',
        ]);

        $project->update($validated);

        // hapus item lama lalu buat ulang
        $project->items()->delete();
        foreach ($validated['items'] as $item) {
            $project->items()->create($item);
        }

        // hapus payment lama lalu buat ulang
        $project->payments()->delete();
        if (!empty($validated['payments'])) {
            foreach ($validated['payments'] as $payment) {
                $project->payments()->create($payment);
            }
        }

        return redirect()->route('index.projects')->with('message', [
            ["success", "Project updated successfully"]
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('index.projects')->with('message', [
            ["success", "Project deleted successfully"]
        ]);
    }

    public function sendInvoice(Project $project)
    {
        $project->load(['items', 'payments']);

        // kalau invoice_date masih null, set hari ini
        if (!$project->invoice_date) {
            $project->invoice_date = now()->toDateString();
            $project->save();
        }

        $pdf = Pdf::loadView('invoices.template', ['project' => $project]);

        $fileName = 'invoice-' . $project->client . '.pdf';
        $path = storage_path('app/invoices/' . $fileName);

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        $pdf->save($path);

        // kirim email
        Mail::send('emails.invoice', ['project' => $project], function ($message) use ($project, $path, $fileName) {
            $message->to($project->email, $project->client)
                ->subject('Invoice Project - ' . $project->client)
                ->attach($path, [
                    'as' => $fileName,
                    'mime' => 'application/pdf',
                ]);
        });

        return redirect()->route('index.projects')->with('message', [
            ["success", "Invoice berhasil dikirim ke email client"]
        ]);
    }

    public function previewInvoice(Project $project)
    {
        $project->load(['items', 'payments']);
        $pdf = Pdf::loadView('invoices.template', compact('project'));
        return $pdf->stream('invoice-' . $project->client . '.pdf');
    }

    public function downloadInvoice(Project $project)
    {
        $project->load(['items', 'payments']);
        $pdf = Pdf::loadView('invoices.template', compact('project'));
        return $pdf->download('invoice-' . $project->client . '.pdf');
    }

    public function markPaid(Project $project)
    {
        $project->update(['is_paid' => true]);
        return redirect()->route('projects.invoice')->with('message', [
            ["success", "Project marked as paid"]
        ]);
    }
}
