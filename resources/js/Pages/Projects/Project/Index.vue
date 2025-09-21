<script setup>
import AuthenticatedLayout from '@/Layouts/Projects/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
   projects: Array,
   pagination: Object 
});

const projectsWithoutInvoice = computed(() =>
  props.projects.filter(p => !p.invoice_date)
);

// Format tanggal
const formatDate = (dateString) => {
    if (!dateString) return '-';
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

// Format mata uang
const formatCurrency = (value) => {
    if (value === null || value === undefined) return 'Rp 0';
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);
};

// Hitung total dari items
const getTotal = (items) => {
    if (!items || !items.length) return 0;
    return items.reduce((sum, item) => sum + (item.qty * item.price), 0);
};

// Hitung total pembayaran
const getPaid = (payments) => {
    if (!payments || !payments.length) return 0;
    return payments.reduce((sum, p) => sum + Number(p.amount), 0);
};
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[95%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Projects</h1>
                    <n-button type="primary" @click="$inertia.visit(route('create.projects'))">
                        Add Project
                    </n-button>
                </div>

                <n-card class="mt-4 overflow-x-auto text-nowrap">
                    <n-table :single-line="false">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Client</th>
                                <th>Phone</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Remaining</th>
                                <th>Event Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(project, index) in projectsWithoutInvoice" :key="project.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ project.client }}</td>
                                <td>{{ project.phone }}</td>
                                <td>
                                    <ul>
                                        <li v-for="item in project.items" :key="item.id">
                                            {{ item.name }} ({{ item.qty }}x) - 
                                            {{ formatCurrency(item.price) }} =
                                            <strong>{{ formatCurrency(item.qty * item.price) }}</strong>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <strong>{{ formatCurrency(getTotal(project.items)) }}</strong>
                                </td>
                                <td>
                                    <span class="text-green-600 font-semibold">
                                        {{ formatCurrency(getPaid(project.payments)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-red-600 font-semibold">
                                        {{ formatCurrency(getTotal(project.items) - getPaid(project.payments)) }}
                                    </span>
                                </td>
                                <td>
                                    {{ formatDate(project.event_start) }} - {{ formatDate(project.event_end) }}
                                </td>
                                <td>
                                    <Link :href="route('edit.projects', project.id)" class="mr-2">
                                        <n-button type="primary">Edit</n-button>
                                    </Link>
                                    <Link :href="route('destroy.projects', project.id)" method="delete">
                                        <n-button type="error">Delete</n-button>
                                    </Link>

                                    <!-- Tombol Invoice -->
                                    <div class="flex flex-col gap-1 mt-2">
                                        <!-- Kalau belum ada invoice_date -->
                                        <template v-if="!project.invoice_date">
                                            <Link :href="route('projects.send-invoice', project.id)" method="post">
                                                <n-button type="info" block>Kirim Invoice</n-button>
                                            </Link>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </n-table>
                </n-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
