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
        return Inertia::render('Home/ShowStudio', [
            'meta' => [
                'title' => 'Studio – Brand Strategy, Visual Communication, Photography & Videography Services',
                'description' => 'Divisi Studio dari Fix Creative Production House menyediakan layanan yang menggabungkan strategi brand, desain visual, serta fotografi dan videografi profesional untuk berbagai kebutuhan. Kami percaya bahwa tampilan visual yang kuat dan relevan mampu meningkatkan daya tarik brand dan memperkuat koneksi dengan audiens secara emosional.',
                'keywords' => 'fotografer, videografer, studio fotografi, studio videografi, studio fotografi bekasi, studio videografi bekasi',
                'image' => asset('img/division/studio.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }
    public function ShowAgency()
    {
        return Inertia::render('Home/ShowAgency', [
            'meta' => [
                'title' => 'Agency – Multimedia Content Production, Branding & Digital Marketing',
                'description' => 'Divisi Agency dari Fix Creative Production House berfokus pada produksi konten multimedia dan pengembangan branding melalui strategi digital marketing yang terukur. Kami hadir untuk memenuhi kebutuhan komunikasi visual yang relevan dengan zaman digital, membantu bisnis tumbuh melalui konten yang beresonansi dengan audiensnya.',
                'keywords' => 'agency, jasa multimedia, jasa personal branding, digital marketing, personal branding',
                'image' => asset('img/division/agency.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }
    public function ShowPhotograph()
    {
        return Inertia::render('Home/ShowPhotograph', [
            'meta' => [
                'title' => 'Fotografi – Wedding & Event Documentation',
                'description' => 'Divisi Fotografi dari Fix Creative Production House berfokus pada dokumentasi acara dan pernikahan, menangkap setiap momen dengan gaya visual storytelling yang kuat. Kami tidak hanya sekadar mengambil gambar, tetapi menghadirkan sebuah cerita melalui setiap foto dan video.',
                'keywords' => 'fotografer, fotografi, fotografi wedding, fotografi event, fotografi wedding bekasi, fotografi event bekasi',
                'image' => asset('img/division/photography.jpg'),
                'url' => url()->current(),
            ]
        ]);
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
        return Inertia::render('Home/About', [
            'meta' => [
                'title' => 'Tentang Kami',
                'description' => 'Fix Creative Production House adalah perusahaan yang bergerak di bidang layanan multimedia dan manajemen event.',
                'keywords' => 'fix creative production house, jasa fotografi, jasa videografi, jasa fotografi bekasi, jasa videografi bekasi, production house',
                'image' => asset('img/about/about.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }

    public function division()
    {
        return Inertia::render('Home/Division', [
            'meta' => [
                'title' => 'Divisi Kami',
                'description' => 'Fix Creative Production House memiliki beberapa divisi yang bergerak di bidang layanan multimedia dan manajemen event.',
                'keywords' => 'fix creative production house, jasa fotografi, jasa videografi, jasa fotografi bekasi, jasa videografi bekasi, production house',
                'image' => asset('img/division/division.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }

    public function portfolio()
    {
        return Inertia::render('Home/Portfolio', [
            'portfolios' => Portfolio::with('category')->get(),
            'meta' => [
                'title' => 'Portfolio',
                'description' => 'Portfolio dari Fix Creative Production House.',
                'keywords' => 'fix creative production house, jasa fotografi, jasa videografi, jasa fotografi bekasi, jasa videografi bekasi, production house',
                'image' => asset('img/portfolio/portfolio.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }

    public function article()
    {
        return Inertia::render('Home/Article', [
            'articles' => Article::with('category')->get(),
            'meta' => [
                'title' => 'Artikel',
                'description' => 'Berita dan Informasi terbaru dari Fix Creative Production House.',
                'keywords' => 'Berita, Artikel, Informasi, Fix Creative Production House, jasa fotografi, jasa videografi, jasa fotografi bekasi, jasa videografi bekasi, production house',
                'image' => asset('img/article/article.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }

    public function career()
    {
        return Inertia::render('Home/Career', [
            'careers' => Career::all(),
            'meta' => [
                'title' => 'Karir',
                'description' => 'Karir terbaru, lowongan pekerjaan di Fix Creative Production House.',
                'keywords' => 'karir, lowongan pekerjaan, fix creative production house, jasa fotografi, jasa videografi, jasa fotografi bekasi, jasa videografi bekasi, production house',
                'image' => asset('img/career/career.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }

    public function contact()
    {
        return Inertia::render('Home/Contact', [
            'meta' => [
                'title' => 'Hubungi Kami',
                'description' => 'Hubungi Kami di Fix Creative Production House.',
                'keywords' => 'hubungi kami, fix creative production house, jasa fotografi, jasa videografi, jasa fotografi bekasi, jasa videografi bekasi, production house',
                'image' => asset('img/contact/contact.jpg'),
                'url' => url()->current(),
            ]
        ]);
    }
}
