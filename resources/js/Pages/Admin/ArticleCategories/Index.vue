<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
   articleCategories: Array,
   pagination: Object 
});

</script>

<template>
    <Head title="Article Categories" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Article Categories</h1>
                    <n-button type="primary" @click="$inertia.visit(route('create.article-categories'))">
                        Add Article Category
                    </n-button>
                </div>
                <n-card class="mt-4">
                    <n-table :single-line="false">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(articleCategory, index) in articleCategories" :key="articleCategory.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ articleCategory.name }}</td>
                                <td class="flex justify-end">
                                    <Link :href="route('edit.article-categories', articleCategory.id)" class="mr-2">
                                        <n-button type="primary">Edit</n-button>
                                    </Link>
                                    <Link :href="route('destroy.article-categories', articleCategory.id)" method="delete">
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
