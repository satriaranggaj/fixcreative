<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head } from '@inertiajs/vue3';
import Header from './Partials/About/Header.vue';
import About from './Partials/About/About.vue';
import Visionmission from './Partials/About/Visionmission.vue';
import Corevalue from './Partials/About/Corevalue.vue';

import Aos from 'aos';
import 'aos/dist/aos.css';

Aos.init();
Aos.init({
    duration: 1000,
    easing: 'ease-in-out',
});
</script>

<template>
    <Head title="About" />

    <HomeLayout>
        <Header />
        <About />
        <Visionmission />
        <Corevalue />
    </HomeLayout>
</template>
