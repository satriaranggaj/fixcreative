<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { ArrowLeft } from '@vicons/fa';
import { computed } from 'vue';

const portfolio = usePage().props.portfolio;

const portfolios = usePage().props.portfolios;

const lastportfolios = computed(() => {
    return portfolios
    .filter((item) => item.id !== portfolio.id)
    .slice()
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 3);
});

const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('id-ID', options);
};

const getImageList = (imageData) => {
    if (!imageData) return []
    if (Array.isArray(imageData)) return imageData
    try {
        return JSON.parse(imageData)
    } catch {
        return []
    }
}

const getFirstImage = (imageData) => {
    if (!imageData) return 'default.jpg'
    if (Array.isArray(imageData)) return imageData[0]
    try {
        return JSON.parse(imageData)[0] ?? 'default.jpg'
    } catch {
        return 'default.jpg'
    }
}
</script>

<template>
    <Head :title="portfolio.title" />

    <HomeLayout>
        <section class="px-4 py-4 pt-32 w-[90%] mx-auto">
            <div>
                <Link :href="route('portfolio')" class="flex w-fit text-gray-700 font-bold hover:text-gray-500"><ArrowLeft class="mr-2 w-5 h-5 mb-4"/>Back To Home</Link>
            </div>
            <article class="bg-white p-6 rounded-lg shadow">
                <n-image-group>
                    <div class="columns-1 sm:columns-2 md:columns-3 gap-2 mb-6 space-y-1/2">
                        <n-image
                            v-for="(img, index) in getImageList(portfolio.image)"
                            :key="index"
                            :src="`/storage/${img}`"
                            class="w-full rounded-lg object-cover"
                            alt="Portfolio Image"
                            :style="{ breakInside: 'avoid', width: '100%', height: 'auto' }"
                            :render-toolbar="renderToolbar"
                        />
                    </div>
                </n-image-group>
                <h1 class="text-3xl font-bold">{{ portfolio.title }}</h1>
                <p class="text-gray-500 mb-4">{{ formatDate(portfolio.created_at) }} - {{ portfolio.category.name }}</p>
                <div class="text-gray-700 leading-relaxed text-base" v-html="portfolio.content"></div>
            </article>
        </section>
        <section class="px-4 py-4 w-[90%] mx-auto">
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap">
                <div v-for="portfolio in lastportfolios" :key="portfolio.id" class="w-full h-full">
                    <n-card hoverable>
                        <img
                            :src="`/storage/${getFirstImage(portfolio.image)}`"
                            class="w-full h-48 object-cover"
                        />
                        <article class="p-4">
                            <h2 class="text-lg font-bold">{{ portfolio.title }}</h2>
                            <div class="flex mb-2 text-gray-500">
                                <p>{{ formatDate(portfolio.created_at) }}</p> <p class="mx-2">-</p> <p>{{ portfolio.category.name }}</p>
                            </div>
                            <div class="text-gray-600 mb-4 text-justify line-clamp-5" v-html="portfolio.content"></div>
                            <n-button class="text-black" type="primary" @click="$inertia.visit(route('portfolio.show', { id: portfolio.slug }))">Read More</n-button>
                        </article>
                    </n-card>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>
<style lang="scss" scoped>
.n-image {
    width: 100%;
    height: auto;
    margin: 3px auto;
}
</style>