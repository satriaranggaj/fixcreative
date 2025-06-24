<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/Career/Header.vue';
import Career from './Partials/Career/Career.vue';

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
        <title>Career</title>
    </Head>

    <HomeLayout>
        <Header />
        <Career />
    </HomeLayout>
</template>
