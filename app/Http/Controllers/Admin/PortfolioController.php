<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);

        return Inertia::render('Admin/Portfolio/Index', [
            'portfolios' => $portfolios->items(),
            'pagination' => $portfolios
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Portfolio/Form', [
            'portfolio_categories' => PortfolioCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'image.*.file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|max:255',
            'content' => 'required|min:10',
        ]);

        $slug = Str::slug($request->title);
        $slug = $this->generateUniqueSlug($slug);

        $imagePaths = [];

        foreach ($request->image as $item) {
            if (isset($item['file']) && $item['file']->isValid()) {
                $imagePaths[] = $item['file']->store('portfolio', 'public');
            }
        }

        Portfolio::create([
            'portfolio_category_id' => $request->portfolio_category_id,
            'slug' => $slug,
            'image' => json_encode($imagePaths), 
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('index.portfolios')->with('message', [
            ["success", "Portfolio created successfully"]
        ]);
    }

    public function edit(Portfolio $portfolio)
    {
        $portfolio->image = json_decode($portfolio->image); // decode image agar jadi array

        return Inertia::render('Admin/Portfolio/Form', [
            'portfolio' => $portfolio,
            'portfolio_categories' => PortfolioCategory::all()
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'image.*.file' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|max:255',
            'content' => 'required|min:10',
        ]);

        $slug = Str::slug($request->title);
        $slug = $this->generateUniqueSlug($slug, $portfolio->id);

        $imagePaths = [];

        foreach ($request->image as $item) {
            if (isset($item['file']) && $item['file']->isValid()) {
                $imagePaths[] = $item['file']->store('portfolio', 'public');
            }
        }

        $portfolio->update([
            'portfolio_category_id' => $request->portfolio_category_id,
            'slug' => $slug,
            'image' => json_encode($imagePaths), 
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('index.portfolios')->with('message', [
            ["success", "Portfolio updated successfully"]
        ]);
    }

    public function destroy(Portfolio $portfolio)
    {
        foreach (json_decode($portfolio->image) as $image) {
            Storage::disk('public')->delete($image);
        }
        $portfolio->delete();
        return redirect()->route('index.portfolios')->with('message', [
            ["success", "Portfolio deleted successfully"]
        ]);
    }

    private function generateUniqueSlug($slug, $portfolioId = null)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Portfolio::where('slug', $slug)->where('id', '!=', $portfolioId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
