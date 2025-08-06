<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { ArrowLeft } from '@vicons/fa';
import { computed } from 'vue';

const portfolio = usePage().props.portfolio;

const portfolios = usePage().props.portfolios;

const getTextOnlyContent = (content) => {
  const div = document.createElement('div');
  div.innerHTML = content;

  // Hapus semua <iframe>
  div.querySelectorAll('iframe').forEach(iframe => iframe.remove());

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
    <Head>
        <title>{{ portfolio.title }}</title>
    </Head>
    <HomeLayout>
        <section class="px-4 py-4 pt-32 w-[90%] mx-auto">
            <div>
                <Link :href="route('portfolio')" class="flex w-fit text-gray-700 font-bold hover:text-gray-500"><ArrowLeft class="mr-2 w-5 h-5 mb-4"/>Back To Home</Link>
            </div>
            <article class="bg-white p-6 rounded-lg shadow">
                <n-image-group>
                    <div
                        :class="[
                        'gap-2 mb-6 space-y-1/2',
                        getImageList(portfolio.image).length === 1
                            ? 'columns-1'
                            : 'columns-1 sm:columns-2 md:columns-3'
                        ]"
                    >
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
                <div class="prose max-w-none content-body" v-html="portfolio.content"></div>
            </article>
        </section>
        <section class="px-4 py-4 w-[90%] mx-auto">
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap">
                <div
                    v-for="portfolio in lastportfolios"
                    :key="portfolio.id"
                    class="card w-full h-full rounded-lg bg-white shadow hover:shadow-md transition-shadow duration-300 overflow-hidden relative"
                >
                <img
                    :src="`/storage/${getFirstImage(portfolio.image)}`"
                    class="w-full h-48 object-cover"
                    alt="Portfolio Image"
                    loading="lazy"
                />
                <div class="desc px-5 py-5">
                    <h2 class="text-lg font-bold text-white">{{ portfolio.title }}</h2>
                    <div class="flex mb-2 text-sm text-gray-300">
                    <p>{{ formatDate(portfolio.created_at) }}</p>
                    <p class="mx-2">-</p>
                    <p>{{ portfolio.category.name }}</p>
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
        </section>

    </HomeLayout>
</template>
<style lang="scss" scoped>
::v-deep(div.content-body) {
    p{
        iframe {
          width: 100%;
          height: auto;
          aspect-ratio: 16 / 9;
          border: none;
          border-radius: 8px;
          margin: 1rem 0;
          display: block;
        }
    }
  img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 0.5rem 0;
  }

  p {
    margin-bottom: 0.75rem;
  }
}

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
