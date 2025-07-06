<?php


use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\CareerController;


Route::fallback(function () {
    return Inertia::render('NotFound', ['status' => 404])->toResponse(request())->setStatusCode(404);
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/division', [HomeController::class, 'division'])->name('division');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/article', [HomeController::class, 'article'])->name('article');
Route::get('/career', [HomeController::class, 'career'])->name('career');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/article/{slug}', [HomeController::class, 'ArticleShow'])->name('article.show');
Route::get('/portfolio/{slug}', [HomeController::class, 'PortfolioShow'])->name('portfolio.show');
Route::get('/division/photograph', [HomeController::class, 'ShowPhotograph'])->name('division.photograph');
Route::get('/division/agency', [HomeController::class, 'ShowAgency'])->name('division.agency');
Route::get('/division/studio', [HomeController::class, 'ShowStudio'])->name('division.studio');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');

    Route::get('/articles', [ArticleController::class, 'index'])->name('index.articles');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('create.articles');
    Route::post('/articles', [ArticleController::class, 'store'])->name('store.articles');
    Route::get('/articles/{article:slug}/edit', [ArticleController::class, 'edit'])->name('edit.articles');
    Route::post('/articles/{article:slug}', [ArticleController::class, 'update'])->name('update.articles');
    Route::delete('/articles/{article:slug}', [ArticleController::class, 'destroy'])->name('destroy.articles');

    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('index.portfolios');
    Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('create.portfolios');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('store.portfolios');
    Route::get('/portfolios/{portfolio:slug}/edit', [PortfolioController::class, 'edit'])->name('edit.portfolios');
    Route::post('/portfolios/{portfolio:slug}', [PortfolioController::class, 'update'])->name('update.portfolios');
    Route::delete('/portfolios/{portfolio:slug}', [PortfolioController::class, 'destroy'])->name('destroy.portfolios');

    Route::get('/article-categories', [ArticleCategoryController::class, 'index'])->name('index.article-categories');
    Route::get('/article-categories/create', [ArticleCategoryController::class, 'create'])->name('create.article-categories');
    Route::post('/article-categories', [ArticleCategoryController::class, 'store'])->name('store.article-categories');
    Route::get('/article-categories/{articleCategory}/edit', [ArticleCategoryController::class, 'edit'])->name('edit.article-categories');
    Route::post('/article-categories/{articleCategory}', [ArticleCategoryController::class, 'update'])->name('update.article-categories');
    Route::delete('/article-categories/{articleCategory}', [ArticleCategoryController::class, 'destroy'])->name('destroy.article-categories');

    Route::get('/portfolio-categories', [PortfolioCategoryController::class, 'index'])->name('index.portfolio-categories');
    Route::get('/portfolio-categories/create', [PortfolioCategoryController::class, 'create'])->name('create.portfolio-categories');
    Route::post('/portfolio-categories', [PortfolioCategoryController::class, 'store'])->name('store.portfolio-categories');
    Route::get('/portfolio-categories/{portfolioCategory}/edit', [PortfolioCategoryController::class, 'edit'])->name('edit.portfolio-categories');
    Route::post('/portfolio-categories/{portfolioCategory}', [PortfolioCategoryController::class, 'update'])->name('update.portfolio-categories');
    Route::delete('/portfolio-categories/{portfolioCategory}', [PortfolioCategoryController::class, 'destroy'])->name('destroy.portfolio-categories');

    Route::get('/careers', [CareerController::class, 'index'])->name('index.careers');
    Route::get('/careers/create', [CareerController::class, 'create'])->name('create.careers');
    Route::post('/careers', [CareerController::class, 'store'])->name('store.careers');
    Route::get('/careers/{career}/edit', [CareerController::class, 'edit'])->name('edit.careers');
    Route::post('/careers/{career}', [CareerController::class, 'update'])->name('update.careers');
    Route::delete('/careers/{career}', [CareerController::class, 'destroy'])->name('destroy.careers');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
