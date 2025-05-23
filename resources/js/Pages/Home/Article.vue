<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/Article/Header.vue';
import Article from './Partials/Article/Article.vue';

import Aos from 'aos';
import 'aos/dist/aos.css';

Aos.init();
Aos.init({
    duration: 1000,
    easing: 'ease-in-out',
});
</script>

<template>
    <Head>
        <title>Article - Jasa Multimedia & Event Organizer</title>
        <meta name="description" content="Fix Creative Production House adalah penyedia layanan multimedia dan pengelola event profesional yang menghadirkan solusi kreatif untuk berbagai kebutuhan bisnis dan individu.">
        <meta name="keywords" content="jasa fotografi, event organizer, wedding organizer, jasa prewedding, jasa foto produk, pembuatan website, production house, fix creative, fixcreative, wedding, event, studio, fotografer, videografer">
        <meta name="author" content="Fix Creative">

        <!-- Open Graph (Facebook & WhatsApp) -->
        <meta property="og:title" content="Fix Creative - Jasa Multimedia & Event Organizer">
        <meta property="og:description" content="Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.">
        <meta property="og:image" content="/img/logo/logo_fixcreative.jpg">
        <meta property="og:url" :content="$page.url">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Fix Creative - Jasa Multimedia & Event Organizer">
        <meta name="twitter:description" content="Fix Creative hadir untuk kebutuhan fotografi, website, dan event Anda.">
        <meta name="twitter:image" content="/img/logo/logo_fixcreative.jpg">
    </Head>

    <HomeLayout>
        <Header />
        <Article />
    </HomeLayout>
</template>
