<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/Portfolio/Header.vue';
import Portfolio from './Partials/Portfolio/Portfolio.vue';

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
        <title>Portfolio - Jasa Multimedia & Event Organizer</title>
    </Head>

    <HomeLayout>
        <Header />
        <Portfolio />
    </HomeLayout>
</template>
