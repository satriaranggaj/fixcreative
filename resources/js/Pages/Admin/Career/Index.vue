<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
   careers: Array,
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
    <Head title="careers" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Careers</h1>
                    <n-button type="primary" @click="$inertia.visit(route('create.careers'))">
                        Add Career
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
                            <tr v-for="(career, index) in careers" :key="career.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ career.title }}</td>
                                <td>{{ formatDate(career.created_at) }}</td>
                                <td>
                                    <Link :href="route('edit.careers', career.id)" class="mr-2">
                                        <n-button type="primary">Edit</n-button>
                                    </Link>
                                    <Link :href="route('destroy.careers', career.id)" method="delete">
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
