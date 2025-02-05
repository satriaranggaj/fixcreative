<script setup>
import { Head, Link } from '@inertiajs/vue3';
import {
    Instagram, 
    FacebookF, 
    Whatsapp
} from '@vicons/fa';

const logoUrl = '/img/logo/logo_fixcreative.png';


</script>
<template>
    <Head title="Coming Soon" />
    <div class="bg-[url('/img/bg/studio.jpg')] bg-cover">
        <div class="bg-gradient-to-tl from-black from-5% via-transparent via-10% to-primary to-80% h-screen overflow-hidden">
            <div>
                <img class="w-32 ml-5" :src="logoUrl" alt="logo">
            </div>

            <div class="flex ml-24 mt-32"> 
                <div class="text-start">
                    <h1 class="text-5xl font-black mb-4">
                        Something Amazing is Coming! ✨
                    </h1>
                    <p class="text-lg">
                        Kami sedang bekerja keras untuk menghadirkan pengalaman digital terbaik! 🎬🎨🚀 <br>
                        Tetap terhubung & nantikan peluncuran resmi website kami.
                    </p>
                </div>
            </div>

            <button class="bg-black text-primary w-fit h-fit px-4 py-2 rounded-full ml-24 mt-10 hover:scale-105 transition-all">
                <a href="`https://www.instagram.com/fixcreativephotography?igsh=MXYyYThiZ2FseDkzNw==`">
                    Kontak Kami
                </a>
            </button>
        </div>
    </div>
</template>