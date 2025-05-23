<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/Home/Header.vue';
import About from './Partials/Home/About.vue';
import Division from './Partials/Home/Division.vue';
import Corevalue from './Partials/Home/Corevalue.vue';
import Article from './Partials/Home/Article.vue';
import Faq from './Partials/Home/Faq.vue';

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
        <title>Fix Creative - Jasa Multimedia & Event Organizer</title>
    </Head>

    <HomeLayout>
        <Header />
        <About />
        <Division />
        <Corevalue />
        <Article />
        <Faq />
    </HomeLayout>
</template>
