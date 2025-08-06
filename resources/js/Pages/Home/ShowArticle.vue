<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { ArrowLeft } from '@vicons/fa';
import { computed } from 'vue';

const article = usePage().props.article;

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
    .filter((item) => item.id !== article.id)
    .slice()
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 3);
});

const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('id-ID', options);
};
</script>

<template>
    <Head>
        <title>{{ article.title }}</title>
    </Head>
    <HomeLayout>
        <section class="px-4 py-4 pt-32 w-[90%] mx-auto">
            <div>
                <Link :href="route('article')" class="flex w-fit text-gray-700 font-bold hover:text-gray-500"><ArrowLeft class="mr-2 w-5 h-5 mb-4"/>Back To Home</Link>
            </div>
            <article class="bg-white p-6 rounded-lg shadow">
                <img :src="'/storage/' + article.image" class="w-full h-[400px] object-cover mb-4 rounded-lg" alt="Article Image" loading="lazy" />
                <h1 class="text-3xl font-bold">{{ article.title }}</h1>
                <p class="text-gray-500 mb-4">{{ formatDate(article.created_at) }} - {{ article.category.name }}</p>
                <div class="prose max-w-none text-gray-700 leading-relaxed text-base" v-html="article.content"></div>
            </article>
        </section>
        <section class="px-4 py-4 w-[90%] mx-auto">
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap">
                <div v-for="article in lastArticles" :key="article.id" class="w-full h-full">
                    <n-card hoverable>
                        <img :src="'/storage/' + article.image" class="w-full h-48 object-cover" alt="Article Image" loading="lazy"/>
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
        </section>
    </HomeLayout>
</template>
<style lang="scss" scoped>
    .rich-text p {
    margin-bottom: 1rem;
    }

    .rich-text h1, h2, h3 {
    margin-top: 1.5rem;
    font-weight: bold;
    }

    .rich-text ul {
    list-style: disc;
    padding-left: 1.25rem;
    margin-bottom: 1rem;
    }

    .rich-text ul li::marker {
    color: black;
    }

    .rich-text ol {
    list-style: decimal;
    padding-left: 1.25rem;
    margin-bottom: 1rem;
    }

    .rich-text img {
    max-width: 100%;
    height: auto;
    }
    
</style>
