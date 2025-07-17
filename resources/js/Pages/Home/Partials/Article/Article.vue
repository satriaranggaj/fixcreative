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

    <div class="mt-12">
      <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
        <div
          v-for="article in articles"
          :key="article.id"
          class="break-inside-avoid w-full"
        >
          <n-card hoverable class="w-full">
            <img
              :src="'/storage/' + article.image"
              class="w-full h-48 object-cover rounded-t"
              alt="Article Image"
              loading="lazy"
            />
            <article class="p-4">
              <h2 class="text-lg font-bold text-primary line-clamp-1">{{ article.title }}</h2>
              <div class="flex mb-2 text-sm text-gray-500">
                <p>{{ formatDate(article.created_at) }}</p>
                <p class="mx-2">-</p>
                <p>{{ article.category.name }}</p>
              </div>

              <div class="text-gray-600 mb-4 text-justify line-clamp-5" v-html="article.content" />

              <n-button
                class="text-black"
                type="primary"
                @click="$inertia.visit(route('article.show', { id: article.slug }))"
              >
                Read More
              </n-button>
            </article>
          </n-card>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Tambahkan agar teks ul/ol tetap rapi jika ada dalam artikel */
ul {
  list-style-type: disc;
  padding-left: 1.25rem;
  margin-bottom: 1rem;
}
ol {
  list-style-type: decimal;
  padding-left: 1.25rem;
  margin-bottom: 1rem;
}
</style>
