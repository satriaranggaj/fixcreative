<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const portfolios = usePage().props.portfolios;
const categories = usePage().props.portfolio_categories;

const selectedCategory = ref(''); // kosong = semua

const filteredPortfolios = computed(() => {
  if (!selectedCategory.value) return portfolios;

  return portfolios.filter(
    (portfolio) => portfolio.category?.id === selectedCategory.value
  );
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

    <!-- ✅ Tab Navigation -->
    <div class="flex justify-center mt-6">
      <n-tabs
        type="line"
        v-model:value="selectedCategory"
        size="large"
        justify-content="center"
      >
        <!-- Tab Semua -->
        <n-tab-pane name="" tab="Semua" />

        <!-- Tab Kategori -->
        <n-tab-pane
          v-for="cat in categories"
          :key="cat.id"
          :name="cat.id"
          :tab="cat.name"
        />
      </n-tabs>
    </div>

    <!-- Portfolios -->
    <div class="mt-12">
      <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
        <div
          v-for="portfolio in filteredPortfolios"
          :key="portfolio.id"
          class="card break-inside-avoid overflow-hidden rounded-lg bg-white shadow hover:shadow-md transition-shadow duration-300"
        >
          <img
            :src="`/storage/${getFirstImage(portfolio.image)}`"
            class="w-full h-full object-cover"
            alt="Portfolio Image"
            loading="lazy"
          />
          <div class="desc px-5 py-5">
            <h2 class="text-lg font-bold text-white">{{ portfolio.title }}</h2>
            <div class="flex mb-2 text-sm">
              <p class="text-white">{{ formatDate(portfolio.created_at) }}</p>
              <p class="mx-2 text-white">-</p>
              <p class="text-white">{{ portfolio.category.name }}</p>
            </div>
            <n-button
              class="text-primary bg-white"
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
<style lang="scss" scoped>
.card {
  overflow: hidden;
  position: relative;
  
  .desc {
    opacity: 0;
    transform: translateY(100%);
    height: fit-content;
    width: 100%;
    background: rgba(0, 0, 0, 0.500);
    position: absolute;
    bottom: 0;
    transition: all 0.5s ease-in-out;
  }
}
.card:hover .desc {
  transform: translateY(0);
  opacity: 1;
}
</style>
