<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function articleShow(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $articles = Article::with('category')->get();

        // Jika bukan request Inertia, render blade fallback untuk crawler
        if (!$request->header('X-Inertia')) {
            return view('app', [
                'article' => $article->toArray(),
                'articles' => $articles->toArray(),
            ]);
        }

        return Inertia::render('Home/ShowArticle', [
            'article' => $article,
            'articles' => $articles,
        ]);
    }

    public function portfolioShow(Request $request, $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $portfolios = Portfolio::with('category')->get();

        if (!$request->header('X-Inertia')) {
            return view('app', [
                'portfolio' => $portfolio->toArray(),
                'portfolios' => $portfolios->toArray(),
            ]);
        }

        return Inertia::render('Home/ShowPortfolio', [
            'portfolio' => $portfolio,
            'portfolios' => $portfolios,
        ]);
    }

    public function index()
    {
        $articles = Article::with('category')->get();

        return Inertia::render('Home/Home', [
            'articles' => $articles
        ]);
    }

    public function about()
    {
        return Inertia::render('Home/About');
    }

    public function division()
    {
        return Inertia::render('Home/Division');
    }

    public function portfolio()
    {
        return Inertia::render('Home/Portfolio', [
            'portfolios' => Portfolio::with('category')->get()
        ]);
    }

    public function article()
    {
        return Inertia::render('Home/Article', [
            'articles' => Article::with('category')->get()
        ]);
    }

    public function contact()
    {
        return Inertia::render('Home/Contact');
    }
}
