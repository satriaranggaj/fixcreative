<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const articles = usePage().props.articles;
const categories = usePage().props.article_categories;

const selectedCategory = ref('');

const filteredArticles = computed(() => {
  if (!selectedCategory.value) return articles;

  return articles.filter(
    (article) => article.category?.id === selectedCategory.value
  );
});

const getTextOnlyContent = (content) => {
  const div = document.createElement('div');
  div.innerHTML = content;

  div.querySelectorAll('img').forEach(img => img.remove());
  div.querySelectorAll('p').forEach(p => {
    const cleaned = p.innerHTML
      .replace(/&nbsp;/gi, '')
      .replace(/[\u200B-\u200D\uFEFF]/g, '')
      .replace(/\s+/g, '');

    if (cleaned === '') {
      p.remove();
    }
  });

  return div.innerHTML;
};

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
      <div class="w-32 h-1 bg-primary-100 mt-2 mx-auto"></div>
    </div>

    <!-- ✅ Tab Navigation -->
    <div class="flex justify-center mt-6">
      <n-tabs
        type="line"
        v-model:value="selectedCategory"
        size="large"
        justify-content="center"
      >
        <n-tab-pane name="" tab="Semua" />
        <n-tab-pane
          v-for="cat in categories"
          :key="cat.id"
          :name="cat.id"
          :tab="cat.name"
        />
      </n-tabs>
    </div>

    <div class="mt-12">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
        <div
          v-for="article in filteredArticles"
          :key="article.id"
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

              <div
                class="text-gray-600 mb-4 text-justify line-clamp-5"
                v-html="getTextOnlyContent(article.content)"
              />

              <n-button
                class="text-white"
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
