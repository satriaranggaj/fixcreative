<script setup>
import { 
    Camera, 
    Lightbulb,
    Bullhorn,
    CalendarDay,
    HandshakeRegular,
    Rocket,
    LaptopCode
 } from '@vicons/fa';
</script>
<template>
    <section>
        <div class="text-center mt-8">
            <h1 class="text-2xl font-bold sm:text-4xl">VISI & MISI</h1>
            <div class="w-32 h-1 bg-primary mt-2 mx-auto"></div>
        </div>
        <div class="flex flex-col justify-center items-center py-10 px-2 mt-2 lg:flex-row">
            <div class="hidden image px-4 py-8 md:w-1/2 lg:block translate-x-28">
                <img src="img/about/visionmission.webp" alt="about" loading="lazy">
            </div>
            <div class="px-4 text-base py-8 lg:w-1/2 md:px-16 sm:px-8">
                <div class="text-base text-justify">
                    <p class="text-base text-justify">
                    <strong>VISI</strong> kami menjadi perusahaan multimedia dan event management terkemuka yang menghadirkan solusi kreatif, inovatif, dan profesional untuk setiap momen berharga, serta berkontribusi dalam perkembangan industri kreatif di Indonesia. dan untuk mencapai visi tersebut fixcreative menjalankan beberapa <strong>MISI</strong> :
                    </p>
                    <div class="text-base text-justify">
                        <br>
                        <ul>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <Camera class="h-12 w-12 p-2 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Menyediakan Layanan Berkualitas Tinggi</strong>
                                    <br>
                                    Memberikan layanan fotografi, videografi, digital marketing, dan produksi multimedia dengan standar profesional dan teknologi terkini.
                                </p>
                            </li>
                            <br>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <Lightbulb class="h-12 w-12 p-2 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Meningkatkan Kreativitas dan Inovasi</strong>
                                    <br>
                                    Terus berinovasi dalam menciptakan konten visual yang menarik dan berdampak, sesuai dengan perkembangan tren industri kreatif.
                                </p>
                            </li>
                            <br>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <Bullhorn class="h-12 w-12 p-2 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Membangun Identitas Brand yang Kuat</strong>
                                    <br>
                                    Membantu klien dalam memperkuat branding dan meningkatkan jangkauan audiens melalui strategi digital marketing yang efektif dan berbasis data.
                                </p>
                            </li>
                            <br>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <CalendarDay class="h-12 w-12 p-2 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Mendukung Kesuksesan Event Klien</strong>
                                    <br>
                                    Menyediakan solusi event management yang terorganisir, profesional, dan kreatif untuk memastikan kesuksesan setiap acara yang dipercayakan kepada kami.
                                </p>
                            </li>
                            <br>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <HandshakeRegular class="h-12 w-12 p-2 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Mengedepankan Kepuasan Klien</strong>
                                    <br>
                                    Berkomitmen untuk memberikan layanan yang responsif, terpercaya, dan sesuai dengan kebutuhan serta harapan klien.
                                </p>
                            </li>
                            <br>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <Rocket class="h-12 w-12 pl-2 pt-3 pb-2 pr-3 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Mengembangkan Sumber Daya Manusia</strong>
                                    <br>
                                    Membangun tim yang kompeten dan kreatif dengan memberikan pelatihan serta kesempatan untuk berkembang di industri multimedia dan event management.
                                </p>
                            </li>
                            <br>
                            <li class="flex items-center flex-wrap sm:flex-nowrap">
                                <LaptopCode class="h-12 w-12 p-2 mr-4 my-4 overflow-visible text-white bg-primary rounded-full" />
                                <p>
                                    <strong>Memanfaatkan Teknologi Digital</strong>
                                    <br>
                                    Mengoptimalkan penggunaan teknologi digital dalam produksi konten multimedia, manajemen event, dan pemasaran agar lebih efisien dan berdampak luas.
                                </p>
                            </li>
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
.image img{
    border-radius: 5vw 0 5vw 0;
    object-fit: cover;
    object-position: center;
    width: 80%;
    aspect-ratio: 5/6;
    box-shadow: -100px 100px 0px #fcc600;
}
</style>