<script setup>
import { 
    ArrowRight,  
    LightbulbRegular, 
    Trophy,
    Handshake, 
    BalanceScale,
    BookOpen,
    Rocket
} from '@vicons/fa'
import { onMounted } from 'vue';

onMounted(() => {
    document.querySelectorAll('.corevalue-card').forEach((card, index) => {
    card.dataset.aos = 'fade-right';
    card.dataset.aosDelay = index * 100;
});
});
</script>
<template>
    <section class="mt-8 px-4 py-4">
        <div class="text-center mb-8">
            <h1 class="text-xl font-bold sm:text-2xl text-primary-500">NILAI INTI</h1>
            <h2 class="text-2xl font-black text-primary sm:text-4xl">KENAPA MEMILIH KAMI</h2>
        </div>
        <div class="flex justify-center flex-wrap">
            <n-card class="m-4 w-fit lg:max-w-96 corevalue-card" hoverable>
                <div class="flex items-center">
                    <h2 class="text-xl font-bold">
                        Creativity & Innovation
                    </h2>
                    <div class="ml-4 px-4 py-3 rounded-full bg-primary text-white">
                        <LightbulbRegular class="h-6"/>
                    </div>
                </div>
                <div class="my-4">
                    <p class="text-base">
                        Kami selalu menghadirkan ide-ide kreatif dan inovatif dalam setiap proyek, memastikan setiap karya memiliki nilai estetika tinggi dan daya tarik yang unik.
                    </p>
                </div>
                <div class="flex justify-end">
                    <ArrowRight class="w-8 rotate-90 lg:rotate-0"/>
                </div>
            </n-card>
            <n-card class="m-4 w-fit lg:max-w-96 corevalue-card" hoverable>
                <div class="flex items-center">
                    <h2 class="text-xl font-bold">
                        Quality & Excellence
                    </h2>
                    <div class="ml-4 px-3 py-3.5 rounded-full bg-primary text-white">
                        <Trophy class="h-6"/>
                    </div>
                </div>
                <div class="my-4">
                    <p class="text-base">
                        Kami berkomitmen untuk memberikan hasil terbaik dengan standar kualitas tinggi, menggunakan teknologi modern dan keahlian profesional di setiap layanan kami.
                    </p>
                </div>
                <div class="flex justify-end">
                    <ArrowRight class="w-8 rotate-90 lg:rotate-0"/>
                </div>
            </n-card>
            <n-card class="m-4 w-fit lg:max-w-96 corevalue-card" hoverable>
                <div class="flex items-center">
                    <h2 class="text-xl font-bold">
                        Client-Centric Approach
                    </h2>
                    <div class="ml-4 px-3 py-3.5 rounded-full bg-primary text-white">
                        <Handshake class="h-6"/>
                    </div>
                </div>
                <div class="my-4">
                    <p class="text-base">
                        Kepuasan klien adalah prioritas utama kami. Kami bekerja dengan pendekatan personal untuk memahami kebutuhan dan visi mereka, menciptakan solusi yang sesuai.
                    </p>
                </div>
                <div class="flex justify-end">
                    <ArrowRight class="w-8 rotate-90 lg:rotate-0"/>
                </div>
            </n-card>
            <n-card class="m-4 w-fit lg:max-w-96 corevalue-card" hoverable>
                <div class="flex items-center">
                    <h2 class="text-xl font-bold">
                        Integrity & Professionalism
                    </h2>
                    <div class="ml-4 px-3 py-3.5 rounded-full bg-primary text-white">
                        <BalanceScale class="h-6"/>
                    </div>
                </div>
                <div class="my-4">
                    <p class="text-base">
                        Kejujuran, transparansi, dan profesionalisme adalah dasar dari setiap kerja sama. Kami selalu menjunjung tinggi etika kerja dalam setiap aspek bisnis kami.
                    </p>
                </div>
                <div class="flex justify-end">
                    <ArrowRight class="w-8 rotate-90 lg:rotate-0"/>
                </div>
            </n-card>
            <n-card class="m-4 w-fit lg:max-w-96 corevalue-card" hoverable>
                <div class="flex items-center">
                    <h2 class="text-xl font-bold">
                        Impactful Storytelling
                    </h2>
                    <div class="ml-4 px-3 py-3.5 rounded-full bg-primary text-white">
                        <BookOpen class="h-6"/>
                    </div>
                </div>
                <div class="my-4">
                    <p class="text-base">
                        Setiap karya yang kami buat tidak hanya estetis, tetapi juga memiliki makna dan mampu menyampaikan cerita yang kuat, meninggalkan kesan mendalam bagi audiens.
                    </p>
                </div>
                <div class="flex justify-end">
                    <ArrowRight class="w-8 rotate-90 lg:rotate-0"/>
                </div>
            </n-card>
            <n-card class="m-4 w-fit lg:max-w-96 corevalue-card" hoverable>
                <div class="flex items-center">
                    <h2 class="text-xl font-bold">
                        Collaboration & Growth
                    </h2>
                    <div class="ml-4 px-3 py-3 rounded-full bg-primary text-white">
                        <Rocket class="h-6"/>
                    </div>  
                </div>
                <div class="my-4">
                    <p class="text-base">
                        Kami percaya bahwa kerja sama yang baik dengan klien dan tim akan menghasilkan karya luar biasa. Kami terus belajar dan berkembang untuk selalu memberikan layanan terbaik.
                    </p>
                </div>
                <div class="flex justify-end">
                    <ArrowRight class="w-8 rotate-90 lg:rotate-0"/>
                </div>
            </n-card>
        </div>
    </section>
</template>
