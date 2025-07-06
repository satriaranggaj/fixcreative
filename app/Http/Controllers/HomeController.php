<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Career;
use App\Models\Portfolio;

class HomeController extends Controller
{
    public function ShowStudio()
    {
        return Inertia::render('Home/ShowStudio');
    }
    public function ShowAgency()
    {
        return Inertia::render('Home/ShowAgency');
    }
    public function ShowPhotograph()
    {
        return Inertia::render('Home/ShowPhotograph');
    }

    public function articleShow($slug)
    {
        $article = Article::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $articles = Article::with('category')->get();

        return Inertia::render('Home/ShowArticle', [
            'article' => $article,
            'articles' => $articles,
            'meta' => [
                'title' => $article->title,
                'description' => substr(strip_tags($article->content), 0, 150),
                'keywords' => implode(', ', [$article->category->name, 'artikel', 'berita', 'informasi']),
                'image' => asset('storage/' . $article->image),
                'url' => url("/home/{$article->slug}"),
            ],
        ]);
    }

    public function portfolioShow($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $portfolios = Portfolio::with('category')->get();

        return Inertia::render('Home/ShowPortfolio', [
            'portfolio' => $portfolio,
            'portfolios' => $portfolios,
            'meta' => [
                'title' => $portfolio->title,
                'description' => substr(strip_tags($portfolio->content), 0, 150),
                'keywords' => implode(', ', [$portfolio->category->name, 'portfolio', 'dokumentasi']),
                'image' => asset('storage/' . (is_array(json_decode($portfolio->image, true)) ? json_decode($portfolio->image, true)[0] : 'default.jpg')),
                'url' => url("/portfolio/{$portfolio->slug}"),
            ],
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

    public function career()
    {
        return Inertia::render('Home/Career', [
            'careers' => Career::all()
        ]);
    }

    public function contact()
    {
        return Inertia::render('Home/Contact');
    }
}
