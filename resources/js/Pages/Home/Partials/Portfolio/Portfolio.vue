<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const portfolios = usePage().props.portfolios;

const lastPortfolios = computed(() => {
    return portfolios
    .slice()
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 3);
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};
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
    <section class="mt-20 px-4 py-4">
        <div class="text-center">
            <h1 class="text-2xl font-bold sm:text-4xl">PORTOFOLIO</h1>
            <div class="w-32 h-1 bg-primary mt-2 mx-auto"></div>
        </div>
        <div class="mt-8">
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap">
                <div v-for="portfolio in lastPortfolios" :key="portfolio.id" class="sm:w-1/2 lg:w-1/3 w-full h-full">
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
                            <div class="text-base text-gray-600 mb-4 text-justify line-clamp-5" v-html="portfolio.content"></div>
                            <n-button class="text-black text-base" type="primary" @click="$inertia.visit(route('portfolio.show', { id: portfolio.slug }))">Read More</n-button>
                        </article>
                    </n-card>
                </div>
            </div>
        </div>
    </section>
</template>