<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const articles = usePage().props.articles;

const getTextOnlyContent = (content) => {
  const div = document.createElement('div');
  div.innerHTML = content;

  // Hapus semua <img>
  div.querySelectorAll('img').forEach(img => img.remove());

  // Hapus elemen <p> yang kosong termasuk jika hanya berisi karakter tak terlihat
  div.querySelectorAll('p').forEach(p => {
    // Bersihkan HTML dari &nbsp;, zero-width space, dan whitespace
    const cleaned = p.innerHTML
      .replace(/&nbsp;/gi, '')
      .replace(/[\u200B-\u200D\uFEFF]/g, '') // zero-width chars
      .replace(/\s+/g, '');

    if (cleaned === '') {
      p.remove();
    }
  });

  return div.innerHTML;
};  

const lastArticles = computed(() => {
    return articles
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
</script>
<template>
    <section class="mt-8 px-4 py-4">
        <div class="text-center mb-8">
            <h1 class="text-xl font-bold sm:text-2xl text-primary-500">BERITA & ARTIKEL</h1>
            <h2 class="text-2xl font-black text-primary sm:text-4xl">UPDATE & INFO TERBARU</h2>
        </div>
        <div>
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap">
                <div v-for="article in lastArticles" :key="article.id" class="w-full h-full">
                    <n-card hoverable>
                        <img :src="'/storage/' + article.image" class="w-full h-48 object-cover" alt="Article Image" loading="lazy" />
                        <article class="p-4">
                            <h2 class="text-lg font-bold line-clamp-1">{{ article.title }}</h2>
                            <div class="flex mb-2 text-gray-500">
                                <p>{{ formatDate(article.created_at) }}</p> <p class="mx-2">-</p> <p>{{ article.category.name }}</p>
                            </div>
                            <div class="text-gray-600 mb-4 text-justify line-clamp-5" v-html="getTextOnlyContent(article.content)" />
                            <n-button class="text-white" type="primary" @click="$inertia.visit(route('article.show', { id: article.slug }))">Read More</n-button>
                        </article>
                    </n-card>
                </div>
            </div>
        </div>
    </section>
</template>