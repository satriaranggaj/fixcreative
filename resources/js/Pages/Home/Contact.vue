<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/Contact/Header.vue';
import Contact from './Partials/Contact/Contact.vue';

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
        <title>Contact - Jasa Multimedia & Event Organizer</title>
    </Head>

    <HomeLayout>
        <Header />
        <Contact />
    </HomeLayout>
</template>
