<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ArticleCategories/Index' , [
            'articleCategories' => ArticleCategory::latest()->paginate(10)->items(),
            'pagination' => ArticleCategory::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ArticleCategories/Form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        ArticleCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('index.article-categories')->with('message', [
            ["success", "Article category created successfully"]
        ]);
    }

    public function edit(ArticleCategory $articleCategory)
    {
        return Inertia::render('Admin/ArticleCategories/Form', [
            'articleCategory' => $articleCategory,
        ]);
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $articleCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('index.article-categories')->with('message', [
            ["success", "Article category updated successfully"]
        ]);
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->articles()->delete();

        $articleCategory->delete();
        return redirect()->route('index.article-categories')->with('message', [
            ["success", "Article category deleted successfully"]
        ]);
    }
}
