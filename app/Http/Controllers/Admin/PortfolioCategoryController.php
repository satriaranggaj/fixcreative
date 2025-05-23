<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;
use App\Http\Controllers\Controller;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/PortfolioCategories/Index' , [
            'portfolioCategories' => PortfolioCategory::latest()->paginate(10)->items(),
            'pagination' => PortfolioCategory::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/PortfolioCategories/Form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        PortfolioCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('index.portfolio-categories')->with('message', [
            ["success", "Portfolio category created successfully"]
        ]);
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return Inertia::render('Admin/PortfolioCategories/Form', [
            'portfolioCategory' => $portfolioCategory,
        ]);
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $portfolioCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('index.portfolio-categories')->with('message', [
            ["success", "Portfolio category updated successfully"]
        ]);
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->portfolios()->delete();

        $portfolioCategory->delete();
        return redirect()->route('index.portfolio-categories')->with('message', [
            ["success", "Portfolio category deleted successfully"]
        ]);
    }
}
