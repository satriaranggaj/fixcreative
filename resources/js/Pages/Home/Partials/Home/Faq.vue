<script setup>
import { ref } from "vue";
import { AngleDown } from "@vicons/fa";

const items = ref([
    {
        title: "Apa saja divisi yang ada di Fix Creative?",
        content: `Fix Creative memiliki tiga divisi utama:
        <ul style="list-style-type:disc" class="ml-4">
            <li><b>Fotografi</b> – Wedding & Event Documentation</li>
            <li><b>Agency</b> – Branding & Digital Marketing</li>
            <li><b>Studio</b> – Multimedia & Content Production</li>
        </ul>`
    },
    {
        title: "Bagaimana cara memesan layanan di Fix Creative?",
        content: "Anda dapat menghubungi kami melalui situs web resmi, media sosial, atau langsung mengunjungi kantor kami untuk konsultasi lebih lanjut."
    },
    {
        title: "Apakah Fix Creative melayani proyek di luar kota?",
        content: "Ya, kami melayani proyek di berbagai lokasi sesuai dengan kebutuhan klien. Silakan hubungi kami untuk detail lebih lanjut terkait jadwal dan biaya perjalanan."
    },
    {
        title: "Apakah Fix Creative menyediakan paket layanan khusus?",
        content: "Ya, kami menyediakan berbagai paket layanan yang dapat disesuaikan dengan kebutuhan dan anggaran klien. Silakan hubungi kami untuk informasi lebih lanjut mengenai paket yang tersedia."
    },
    {
        title: "Berapa lama waktu pengerjaan untuk setiap layanan?",
        content: "Waktu pengerjaan bervariasi tergantung pada jenis proyek dan kompleksitasnya. Estimasi waktu akan diberikan setelah konsultasi awal dan perencanaan proyek dilakukan."
    },
    {
        title: "Apakah hasil dokumentasi dan produksi bisa direvisi?",
        content: "Ya, kami menyediakan layanan revisi sesuai dengan kesepakatan awal. Detail revisi akan dibahas lebih lanjut saat kontrak layanan dibuat."
    }
]);

const activeAccordionIndex = ref(-1);

const toggleAccordion = (index) => {
    activeAccordionIndex.value = activeAccordionIndex.value === index ? -1 : index;
};
</script>

<template>
    <section class="mt-8 px-4 py-4">
        <div class="text-center mb-8">
            <h1 class="text-xl font-bold sm:text-2xl text-primary-500">FAQ - Fix Creative</h1>
            <h2 class="text-2xl font-black text-primary sm:text-4xl">INFORMASI SEPUTAR LAYANAN</h2>
        </div>
        <div class="px-4 py-4 w-[90%] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div v-for="(item, index) in items" :key="index" class="rounded-lg overflow-hidden">
                    <div class="accordion rounded-xl overflow-hidden transition-all shadow-md hover:shadow-lg">
                        <div 
                            class="accordion-header bg-primary text-white py-4 px-6 cursor-pointer flex justify-between" 
                            @click="toggleAccordion(index)"
                        >
                            <span class="font-semibold sm:text-lg">{{ item.title }}</span>
                            <AngleDown class="w-5 transition-all duration-300" :class="{ 'rotate-180': activeAccordionIndex === index }"/>
                        </div>
                        <div 
                            class="accordion-body transition-all duration-300 overflow-hidden bg-primary-700 text-white" 
                            :class="{ 'max-h-96': activeAccordionIndex === index, 'max-h-0': activeAccordionIndex !== index }"
                        >
                            <div class="p-4" v-html="item.content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.accordion-body {
    transition: max-height 0.3s ease-in-out;
}
</style>