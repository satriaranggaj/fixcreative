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
  if (!imageData) return 'default.jpg';
  if (Array.isArray(imageData)) return imageData[0];
  try {
    return JSON.parse(imageData)[0] ?? 'default.jpg';
  } catch {
    return 'default.jpg';
  }
};
</script>

<template>
  <section class="mt-20 px-4 py-4">
    <div class="text-center">
      <h1 class="text-2xl font-bold sm:text-4xl">PORTOFOLIO</h1>
      <div class="w-32 h-1 bg-primary-100 mt-2 mx-auto"></div>
    </div>

    <div class="mt-12">
      <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
        <div
          v-for="portfolio in lastPortfolios"
          :key="portfolio.id"
          class="break-inside-avoid overflow-hidden rounded-lg bg-white shadow hover:shadow-md transition-shadow duration-300"
        >
          <img
            :src="`/storage/${getFirstImage(portfolio.image)}`"
            class="w-full h-auto object-cover"
            alt="Portfolio Image"
            loading="lazy"
          />
          <div class="p-4">
            <h2 class="text-lg font-bold text-primary">{{ portfolio.title }}</h2>
            <div class="flex mb-2 text-sm text-gray-500">
              <p>{{ formatDate(portfolio.created_at) }}</p>
              <p class="mx-2">-</p>
              <p>{{ portfolio.category.name }}</p>
            </div>
            <div
              class="text-gray-600 mb-4 text-justify line-clamp-5"
              v-html="portfolio.content"
            />
            <n-button
              class="text-white"
              type="primary"
              size="small"
              @click="$inertia.visit(route('portfolio.show', { id: portfolio.slug }))"
            >
              Read More
            </n-button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.break-inside-avoid {
  break-inside: avoid;
}

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
