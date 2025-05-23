<script setup>
import AppStore from '@/stores/ApplicationStore.js';
import Navbar from '@/Components/Home/Organism/Navbar.vue';
import AppMessageListener from '@/Components/Home/Organism/AppMessageListener.vue';
import Footer from '@/Components/Home/Organism/Footer.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Fix Creative - Jasa Multimedia & Event Organizer</title>
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

    <n-config-provider 
        :theme="AppStore.theme" 
        :theme-overrides="AppStore.themeOverrides" 
        class="bg-gray-100"
    >
        <n-spin :show="AppStore.loadingStack > 0">
            <n-message-provider :max="3" placement="top">
                <n-dialog-provider>
                    <AppMessageListener>
                        <Navbar />
                        <div class="overflow-hidden">
                            <div class="min-h-screen">
                                <!-- Page Content -->
                                <main>
                                    <slot />
                                </main>
                            </div>
                        </div>
                        <Footer />
                    </AppMessageListener>
                </n-dialog-provider>
            </n-message-provider>
        </n-spin>
    </n-config-provider>
</template>
