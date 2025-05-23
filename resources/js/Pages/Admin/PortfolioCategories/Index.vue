<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
   portfolioCategories: Array,
   pagination: Object 
});

</script>

<template>
    <Head title="Portfolio Categories" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Portfolio Categories</h1>
                    <n-button type="primary" @click="$inertia.visit(route('create.portfolio-categories'))">
                        Add Portfolio Category
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
                            <tr v-for="(portfolioCategory, index) in portfolioCategories" :key="portfolioCategory.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ portfolioCategory.name }}</td>
                                <td class="flex justify-end">
                                    <Link :href="route('edit.portfolio-categories', portfolioCategory.id)" class="mr-2">
                                        <n-button type="primary">Edit</n-button>
                                    </Link>
                                    <Link :href="route('destroy.portfolio-categories', portfolioCategory.id)" method="delete">
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
