<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);

        return Inertia::render('Admin/Article/Index', [
            'articles' => $articles->items(),
            'pagination' => $articles
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Article/Form', [
            'article_categories' => ArticleCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_category_id' => 'required|exists:article_categories,id',
            'image.file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|max:255',
            'content' => 'required|min:10',
        ]);

        $slug = Str::slug($request->title);
        $slug = $this->generateUniqueSlug($slug);

        $file = $request->file('image.file');
        $imagePath = $file->store('article', 'public');

        Article::create([
            'article_category_id' => $request->article_category_id,
            'slug' => $slug,
            'image' => $imagePath,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('index.articles')->with('message', [
            ["success", "Article created successfully"]
        ]);
    }

    public function edit(Article $article)
    {
        return Inertia::render('Admin/Article/Form', [
            'article' => $article,
            'article_categories' => ArticleCategory::all()
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'article_category_id' => 'required|exists:article_categories,id',
            'image.file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|max:255',
            'content' => 'required|min:10',
        ]);

        $slug = Str::slug($request->title);
        $slug = $this->generateUniqueSlug($slug, $article->id);

        if ($request->hasFile('image.file')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $file = $request->file('image.file');
            $imagePath = $file->store('article', 'public');
            $article->image = $imagePath;
        }

        $article->update([
            'article_category_id' => $request->article_category_id,
            'slug' => $slug,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('index.articles')->with('message', [
            ["success", "Article updated successfully"]
        ]);
    }


    public function destroy(Article $article)
    {
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('index.articles')->with('message', [
            ["success", "Article deleted successfully"]
        ]);
    }

    private function generateUniqueSlug($slug, $articleId = null)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Article::where('slug', $slug)->where('id', '!=', $articleId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}