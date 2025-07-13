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

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? 'Fix Creative - Jasa Multimedia & Event Organizer' }}">
    <meta name="twitter:description" content="{{ $meta['description'] ?? 'Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.' }}">
    <meta name="twitter:image" content="{{ $meta['image'] ?? asset('img/logo/logo_fixcreative.jpg') }}">

    <title inertia>{{ $meta['title'] ?? config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('img/logo/logo_fixcreative.ico') }}" type="image/x-icon">
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
