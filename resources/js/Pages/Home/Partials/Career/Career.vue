<script setup>
import { usePage } from '@inertiajs/vue3';

const careers = usePage().props.careers;

const formatCategory = (category) => {
  switch (category) {
    case 'full_time':
      return 'Full Time';
    case 'part_time':
      return 'Part Time';
    case 'both':
      return 'Full Time & Part Time';
    default:
      return category;
  }
};

const generateMailtoLink = (title, category) => {
  const subject = `Lamaran: ${title} - ${formatCategory(category)}`;
  const body = `Halo Tim Fix Creative,\n\nSaya tertarik untuk melamar posisi ${title} (${formatCategory(category)}). Berikut saya lampirkan CV dan data diri saya.\n\nTerima kasih.\n\nHormat saya,`;
  return `mailto:fixcreativecoid@gmailcom?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
};
</script>

<template>
  <section class="mt-20 px-4 py-4">
    <div class="text-center">
      <h1 class="text-2xl font-bold sm:text-4xl">KARIR</h1>
      <div class="w-32 h-1 bg-primary mt-2 mx-auto"></div>
      <div class="desc mt-8 text-xl">
        <p>Kami selalu mencari orang-orang yang memiliki minat dan kemampuan untuk bekerja sama dengan kami.</p>
        <br />
        <p>LOWONGAN</p>
      </div>
    </div>
    <div class="mt-16">
        <div class="columns-1 sm:columns-2 gap-6 space-y-6">
            <div
                v-for="career in careers"
                :key="career.id"
                class="break-inside-avoid w-full"
            >
                <n-card class="w-full px-8 py-16 shadow-[5px_5px_5px_-2px] shadow-primary">
                    <article class="p-4">
                        <h2 class="text-2xl font-bold text-primary">{{ career.title }}</h2>
                        <h3 class="text-base my-4 font-bold text-gray-600">{{ formatCategory(career.category) }}</h3>

                        <div class="text-base text-gray-600 mb-4 text-justify" v-html="career.description"></div>

                        <p class="text-base mb-4 font-bold">Tanggung Jawab :</p>
                        <div class="text-base text-gray-600 mb-4 prose max-w-none text-justify" v-html="career.responsibilities"></div>

                        <p class="text-base mb-4 font-bold">Kriteria :</p>
                        <div class="text-base text-gray-600 mb-4 prose max-w-none text-justify" v-html="career.criteria"></div>

                        <a
                        :href="generateMailtoLink(career.title, career.category)"
                        class="inline-block mt-4 px-4 py-2 text-white bg-primary hover:bg-primary/80 rounded"
                        >
                        Lamar via Email
                        </a>
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
    }
    ol {
        list-style-type: decimal;
        padding-left: 1.25rem;
    }
</style>
