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
        <title>Article</title>
    </Head>

    <HomeLayout>
        <Header />
        <Article />
    </HomeLayout>
</template>
