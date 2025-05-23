<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
   articles: Array,
   pagination: Object 
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
    <Head title="Articles" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Articles</h1>
                    <n-button type="primary" @click="$inertia.visit(route('create.articles'))">
                        Add Article
                    </n-button>
                </div>
                <n-card class="mt-4">
                    <n-table :single-line="false">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(article, index) in articles" :key="article.slug">
                                <td>{{ index + 1 }}</td>
                                <td>{{ article.title }}</td>
                                <td>{{ formatDate(article.created_at) }}</td>
                                <td>
                                    <Link :href="route('edit.articles', article.slug)" class="mr-2">
                                        <n-button type="primary">Edit</n-button>
                                    </Link>
                                    <Link :href="route('destroy.articles', article.slug)" method="delete">
                                        <n-button type="error">Delete</n-button>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </n-table>
                </n-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
