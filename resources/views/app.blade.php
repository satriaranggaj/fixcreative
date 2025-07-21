@php
    $meta = $page['props']['meta'] ?? [];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Gunakan meta tags dari halaman jika ada, jika tidak pakai default -->
    <meta name="description" content="{{ $meta['description'] ?? 'Fix Creative Production House adalah penyedia layanan multimedia dan pengelola event profesional yang menghadirkan solusi kreatif untuk berbagai kebutuhan bisnis dan individu.' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? 'jasa fotografi, event organizer, wedding organizer, jasa prewedding, jasa foto produk, pembuatan website, production house, fix creative, fixcreative, wedding, event, studio, fotografer, videografer' }}">
    <meta name="author" content="Fix Creative">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $meta['title'] ?? 'Fix Creative - Jasa Multimedia & Event Organizer' }}">
    <meta property="og:description" content="{{ $meta['description'] ?? 'Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.' }}">
    <meta property="og:image" content="{{ $meta['image'] ?? asset('img/logo/logo_fixcreative.jpg') }}">
    <meta property="og:url" content="{{ $meta['url'] ?? url()->current() }}">

    <!-- Schema.org for Google -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "PhotoStudio",
            "name": "Fix Creative Studio",
            "image": "https://fixcreative.co.id/favicons/favicon.ico",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Bekasi",
                "addressRegion": "Jawa Barat",
                "postalCode": "17426",
                "streetAddress": "Jl. Wibawa Mukti II No.RT06/04, Kel. Jatisari, Kec. Jatiasih"
            },
            "openingHours": "Mo-Su 08:00-21:00",
            "telephone": "+62 858 9493 4143",
            "url": "https://fixcreative.co.id"
        }
    </script>
    <!-- Schema.org for Google -->

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? 'Fix Creative - Jasa Multimedia & Event Organizer' }}">
    <meta name="twitter:description" content="{{ $meta['description'] ?? 'Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.' }}">
    <meta name="twitter:image" content="{{ $meta['image'] ?? asset('img/logo/logo_fixcreative.jpg') }}">

    <title inertia>{{ $meta['title'] ?? config('app.name', 'Laravel') }}</title>

    <meta name="msapplication-config" content="{{ asset('favicons/browserconfig.xml') }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body class="font-sans antialiased">
    @inertia

</body>
</html>
