<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->paginate(10);

        return Inertia::render('Admin/Career/Index', [
            'careers' => $careers->items(),
            'pagination' => $careers
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Career/Form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:full_time,part_time,both',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'criteria' => 'required|string',
        ]);

        Career::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'criteria' => $request->criteria,
        ]);

        return redirect()->route('index.careers')->with('message', [
            ["success", "Career created successfully"]
        ]);
    }

    public function edit(Career $career)
    {
        return Inertia::render('Admin/Career/Form', [
            'career' => $career, // lowercase key agar cocok dengan props di Vue
        ]);
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:full_time,part_time,both',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'criteria' => 'required|string',
        ]);

        $career->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'criteria' => $request->criteria,
        ]);

        return redirect()->route('index.careers')->with('message', [
            ["success", "Career updated successfully"]
        ]);
    }

    public function destroy(Career $career)
    {
        $career->delete();

        return redirect()->route('index.careers')->with('message', [
            ["success", "Career deleted successfully"]
        ]);
    }
}
