<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $isArticlePage = request()->is('home/*') && isset($article);
            $isPortfolioPage = request()->is('portfolio/*') && isset($portfolio);
        @endphp

        <meta name="description" content="
            {{ 
                $isArticlePage 
                    ? ($article['excerpt'] ?? $article['title']) 
                    : ($isPortfolioPage 
                        ? ($portfolio['excerpt'] ?? $portfolio['title']) 
                        : 'Fix Creative Production House adalah penyedia layanan multimedia dan pengelola event profesional yang menghadirkan solusi kreatif untuk berbagai kebutuhan bisnis dan individu.'
                    )
            }}">
        <meta property="og:title" content="
            {{ 
                $isArticlePage 
                    ? $article['title'] 
                    : ($isPortfolioPage 
                        ? $portfolio['title'] 
                        : 'Fix Creative - Jasa Multimedia & Event Organizer'
                    )
            }}">
        <meta property="og:description" content="
            {{ 
                $isArticlePage 
                    ? ($article['excerpt'] ?? $article['title']) 
                    : ($isPortfolioPage 
                        ? ($portfolio['excerpt'] ?? $portfolio['title']) 
                        : 'Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.'
                    )
            }}">
        <meta property="og:image" content="
            {{ 
                $isArticlePage 
                    ? asset('storage/' . $article['image']) 
                    : ($isPortfolioPage 
                        ? asset('storage/' . $portfolio['image']) 
                        : asset('img/logo/logo_fixcreative.jpg')
                    )
            }}">
        <meta property="og:url" content="{{ url()->current() }}">

        <meta name="twitter:title" content="
            {{ 
                $isArticlePage 
                    ? $article['title'] 
                    : ($isPortfolioPage 
                        ? $portfolio['title'] 
                        : 'Fix Creative - Jasa Multimedia & Event Organizer'
                    )
            }}">
        <meta name="twitter:description" content="
            {{ 
                $isArticlePage 
                    ? ($article['excerpt'] ?? $article['title']) 
                    : ($isPortfolioPage 
                        ? ($portfolio['excerpt'] ?? $portfolio['title']) 
                        : 'Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.'
                    )
            }}">
        <meta name="twitter:image" content="
            {{ 
                $isArticlePage 
                    ? asset('storage/' . $article['image']) 
                    : ($isPortfolioPage 
                        ? asset('storage/' . $portfolio['image']) 
                        : asset('img/logo/logo_fixcreative.jpg')
                    )
            }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('img/logo/logo_fixcreative.ico') }}" type="image/x-icon">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
    </body>
</html>
