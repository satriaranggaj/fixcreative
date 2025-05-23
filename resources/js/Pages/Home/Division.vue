<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/Division/Header.vue';
import Division from './Partials/Division/Division.vue';


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
        <title>Division</title>
    </Head>

    <HomeLayout>
        <Header />
        <Division />
    </HomeLayout>
</template>
