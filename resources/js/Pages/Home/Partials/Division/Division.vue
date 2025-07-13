<script setup>
import { AngleRight } from '@vicons/fa';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <section class="mt-20 px-4 py-4">
        <div class="text-center">
            <h1 class="text-2xl font-bold sm:text-4xl">DIVISI</h1>
            <div class="w-32 h-1 bg-primary mt-2 mx-auto"></div>
        </div>
        <div class="mt-16">
            <div class="my-8 md:px-8 lg:flex justify-center">
                <div data-aos="fade-right" class="w-full p-8 lg:w-2/5">
                    <img src="img/division/photography.webp" alt="photography" width="100%" loading="lazy">
                </div>
                <div class="w-full p-4 lg:w-1/2">
                    <h2 class="text-2xl font-bold mb-8 md:text-3xl">
                        Fotografi – Wedding & Event Documentation
                        <span class="h-1 w-24 mt-4 bg-primary block"></span>
                    </h2>
                    <p class="text-base text-justify">
                        Divisi Fotografi Fix Creative berfokus pada dokumentasi pernikahan dan acara, mengabadikan setiap momen dengan sentuhan profesional dan storytelling yang kuat. Kami memastikan setiap foto dan video menangkap emosi serta suasana dengan hasil berkualitas tinggi.
                        <br><br>
                        Dengan teknik dan peralatan modern, kami menghadirkan dokumentasi yang sesuai dengan konsep acara, dari pernikahan intim hingga event besar. Setiap karya kami bukan sekadar gambar, melainkan representasi penuh dari keindahan dan makna sebuah peristiwa.
                        <br><br>
                        Kami memahami pentingnya kenangan yang abadi, sehingga selalu berusaha menciptakan visual yang tidak hanya estetis tetapi juga emosional. Kolaborasi dengan klien menjadi kunci utama kami untuk menghasilkan dokumentasi yang benar-benar personal dan berkesan.
                    </p>
                    <Link :href="route('division.photograph')" class="text-base flex items-center w-fit px-8 py-1 bg-primary rounded-full mt-8 text-black hover:bg-black hover:text-primary transition-all duration-300" round>
                        Selengkapnya <AngleRight class="ml-2 h-4" />
                    </Link>
                </div>
            </div>
            <div class="my-8 md:px-8 lg:flex justify-center flex-row-reverse">
                <div data-aos="fade-left" class="w-full p-8 lg:w-2/5">
                    <img src="img/division/agency.webp" alt="agency" width="100%" loading="lazy">
                </div>
                <div class="w-full p-4 lg:w-1/2">
                    <h2 class="text-2xl font-bold mb-8 md:text-3xl">
                        Agency – Multimedia Content Production, Branding & Digital Marketing
                        <span class="h-1 w-24 mt-4 bg-primary block"></span>
                    </h2>
                    <p class="text-base text-justify">
                        Divisi Agency FixCreative menyediakan layanan produksi konten multimedia seperti video, multicam livestreaming, animasi, dan berbagai format audiovisual lainnya. Kami mengutamakan storytelling visual yang kuat dan sesuai dengan kebutuhan brand.
                        <br><br>
                        Dengan dukungan teknologi modern dan tim profesional, kami menciptakan konten yang estetis, relevan, dan berdampak tinggi untuk promosi, company profile, iklan digital, hingga media sosial.
                        <br><br>
                        Kami percaya visual yang tepat dapat memperkuat citra brand. Karena itu, setiap konten dirancang berdasarkan strategi komunikasi yang matang agar pesan tersampaikan secara jelas dan efektif.
                    </p>
                    <Link :href="route('division.agency')" class="text-base flex items-center w-fit px-8 py-1 bg-primary rounded-full mt-8 text-black hover:bg-black hover:text-primary transition-all duration-300" round>
                        Selengkapnya <AngleRight class="ml-2 h-4" />
                    </Link>
                </div>
            </div>
            <div class="my-8 md:px-8 lg:flex justify-center">
                <div data-aos="fade-right" class="w-full p-8 lg:w-2/5">
                    <img src="img/division/studio.webp" alt="studio" width="100%" loading="lazy">
                </div>
                <div class="w-full p-4 lg:w-1/2">
                    <h2 class="text-2xl font-bold mb-8 md:text-3xl">
                        Studio – Brand Strategy, Visual Communication, Photography & Videography Services
                        <span class="h-1 w-24 mt-4 bg-primary block"></span>
                    </h2>
                    <p class="text-base text-justify">
                        Divisi Studio Fix Creative membantu membangun identitas brand melalui strategi kreatif dan komunikasi visual yang tepat sasaran. Kami menghadirkan desain yang menarik dan bermakna untuk membangun koneksi emosional dengan audiens.
                        <br><br>
                        Kami juga menawarkan layanan fotografi dan videografi profesional, mulai dari sesi indoor maupun outdoor, termasuk foto keluarga, prewedding, hingga kebutuhan branding dan produk. Setiap hasil foto dikemas dengan pendekatan visual yang estetis dan relevan.
                        <br><br>
                        Dengan tim berpengalaman dan analisis tren industri, kami menciptakan solusi visual yang strategis dan berdampak, mendukung kebutuhan promosi digital maupun branding jangka panjang.
                    </p>
                    <Link :href="route('division.studio')" class="text-base flex items-center w-fit px-8 py-1 bg-primary rounded-full mt-8 text-black hover:bg-black hover:text-primary transition-all duration-300" round>
                        Selengkapnya <AngleRight class="ml-2 h-4" />
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
