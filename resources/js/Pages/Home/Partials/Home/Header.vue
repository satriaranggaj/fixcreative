<script setup>
    import { AngleRight } from '@vicons/fa';
    import { Link } from '@inertiajs/vue3';
</script>
<template>
    <header class="pt-5 mt-16 bg-primary-600 relative flex items-center">
        <div class="absolute z-40 px-8 lg:px-32 xl:w-[80%]">
            <h1 class="text-3xl font-bold md:text-7xl sm:text-5xl">YOUR MULTIMEDIA GROWTH PARTNER</h1>
            <p  class="text-lg font-semibold mt-8 sm:text-3xl">Creativity Without Limits, Results Beyond Expectations.</p>
            <Link :href="route('about')" class="flex items-center w-fit px-8 py-2 bg-black rounded-full  mt-8 text-primary text-lg hover:bg-primary hover:text-black transition-all duration-300" round>
                Telusuri <AngleRight class="ml-2 h-4" />
            </Link>
        </div>
        <n-carousel
            effect="custom"
            :transition-props="{ name: 'creative' }"
            style="width: 100%; height: 88dvh"
            :show-arrow="false"
            :show-dots="false"
            :interval="7000"
            loop
            autoplay
        >
            <img
            class="carousel-img blur-sm"
            src="img/bg/carousel.webp"
            alt="carousel-1"
            loading="lazy"
            >
            <img
            class="carousel-img blur-sm"
            src="img/bg/carousel-2.webp"
            alt="carousel-2"
            loading="lazy"
            >
        </n-carousel>
    </header>
</template>
<style scoped>
.carousel-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

:deep(.creative-enter-from),
:deep(.creative-leave-to) {
  opacity: 0;
  transform: scale(1.5);
}

:deep(.creative-enter-active),
:deep(.creative-leave-active) {
  transition: all 5s ease-in-out;
}
</style>