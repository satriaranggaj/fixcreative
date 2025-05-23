<script setup>
import { Link } from '@inertiajs/vue3';
import { 
         LocationArrow, 
         TabletAlt, 
         Envelope, 
         Instagram, 
         Facebook, 
         Tiktok, 
         Youtube 
         } from '@vicons/fa';
</script>
<template>
    <footer class="bg-primary-300 mt-16">
        <div class="flex flex-col justify-between md:flex-row">
            <div class="px-8 py-6 bg-primary md:w-[35%] sm:px-16 sm:py-12">
                <a href="https://maps.app.goo.gl/bbf76pkuc1d8zW1R8" target="_blank" class="address">
                    <p class="flex font-bold text-lg items-center">
                        <LocationArrow class="mr-2 w-4" /> Fixcreative
                    </p>
                    <p class="text-base mt-1 ml-6">
                        Jl. Wibawa Mukti II No.RT06/04, Jatisari, Kec. Jatiasih, Kota Bks, Jawa Barat 17426
                    </p>
                </a>
                <a href="tel:085888074561" target="_blank" class="phone">
                    <p class="text-base flex mt-2">
                        <TabletAlt class="mr-2 w-4" /> +62 858-8807-4561
                    </p>
                </a>
                <a href="mailto:fixcreativecoid@gmailcom" target="_blank" class="email">
                    <p class="text-base flex mt-2">
                        <Envelope class="mr-2 w-4" /> fixcreativecoid@gmail.com
                    </p>
                </a>
                <div class="flex gap-2 items-center mt-4">
                    <a href="https://www.instagram.com/fixcreativestudio.id/" target="_blank">
                        <Instagram class="mr-2 w-5 hover:scale-125 transition-all" />
                    </a>
                    <a href="https://www.facebook.com/share/1BizcmaV4W/" target="_blank">
                        <Facebook class="mr-2 w-5 hover:scale-125 transition-all" />
                    </a>
                    <a href="https://www.tiktok.com/@fixcreativephotography?_t=ZS-8uTdIK6Hn86&_r=1" target="_blank">
                        <Tiktok class="mr-2 w-5 hover:scale-125 transition-all" />
                    </a>
                    <a href="https://youtube.com/@fixcreativephotography2654?si=avV9s2FGA_s0p3kc" target="_blank">
                        <Youtube class="mr-2 w-5 hover:scale-125 transition-all" />
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-8 justify-between px-8 py-6 md:w-[65%] sm:flex-row sm:px-16 sm:py-12">
                <div>
                    <Link :href="route('home')">
                        <p class="opacity-50 font-bold text-lg hover:opacity-100 transition-all" :class="{'opacity-100': route().current('home')}">Beranda</p>
                    </Link>
                    <Link :href="route('about')">
                        <p class="opacity-50 font-bold text-lg hover:opacity-100 transition-all" :class="{'opacity-100': route().current('about')}">Tentang Kami</p>
                    </Link>
                </div>
                <div>
                    <p class="font-bold text-lg">DIVISI</p>
                    <ul class="ml-4" style="list-style-type:disc;">
                        <li>
                            <Link class="text-base">
                                Fotografi – Wedding & Event Documentation
                            </Link>
                        </li>
                        <li>
                            <Link class="text-base">
                                Agency – Branding & Digital Marketing
                            </Link>
                        </li>
                        <li>
                            <Link class="text-base">
                                Studio – Multimedia & Content Production
                            </Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <Link>
                        <p class="opacity-50 font-bold text-lg hover:opacity-100 transition-all">
                            Portofolio
                        </p>
                    </Link>
                    <Link>
                        <p class="opacity-50 font-bold text-lg hover:opacity-100 transition-all">
                            Karir
                        </p>
                    </Link>
                    <Link>
                        <p class="opacity-50 font-bold text-lg hover:opacity-100 transition-all">
                            Hubungi Kami
                        </p>
                    </Link>
                </div>
            </div>
        </div>
        <div class="bg-black text-white text-center text-xs py-2">
            <p>Copyright &copy; 2025 Fix Creative. All rights reserved.</p>
        </div>
    </footer>
</template>