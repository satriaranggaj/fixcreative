<script setup>
import { usePage } from '@inertiajs/vue3';

const articles = usePage().props.articles;

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};
</script>
<template>
    <section class="mt-20 px-4 py-4">
        <div class="text-center">
            <h1 class="text-2xl font-bold sm:text-4xl">ARTICLES</h1>
            <div class="w-32 h-1 bg-primary mt-2 mx-auto"></div>
        </div>
        <div class="mt-8">
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap">
                <div v-for="article in articles" :key="article.id" class="sm:w-1/2 lg:w-1/3 w-full h-full">
                    <n-card hoverable>
                        <img :src="'/storage/' + article.image" class="w-full h-48 object-cover" />
                        <article class="p-4">
                            <h2 class="text-lg font-bold">{{ article.title }}</h2>
                            <div class="flex mb-2 text-gray-500">
                                <p>{{ formatDate(article.created_at) }}</p> <p class="mx-2">-</p> <p>{{ article.category.name }}</p>
                            </div>
                            <div class="text-gray-600 mb-4 text-justify line-clamp-5" v-html="article.content"></div>
                            <n-button class="text-black" type="primary" @click="$inertia.visit(route('article.show', { id: article.slug }))">Read More</n-button>
                        </article>
                    </n-card>
                </div>
            </div>
        </div>
    </section>
</template>