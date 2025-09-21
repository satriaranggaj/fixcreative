<script setup>
import AuthenticatedLayout from '@/Layouts/Projects/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
   projects: Array,
   pagination: Object 
});

const projectsWithInvoice = computed(() =>
  props.projects.filter(p => p.invoice_date)
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

const getDueDate = (invoiceDate, days = 30) => {
  if (!invoiceDate) return '-';
  const date = new Date(invoiceDate);
  date.setDate(date.getDate() + days);
  return formatDate(date);
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
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[95%]">
                <div class="px-4">
                    <h1 class="text-2xl font-bold">Invoice</h1>
                </div>

                <n-card class="mt-4 overflow-x-auto text-nowrap">
                    <n-table :single-line="false">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Client</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Remaining</th>
                                <th>Invoice Date</th>
                                <th>Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(project, index) in projectsWithInvoice" :key="project.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ project.client }}</td>
                                <td>{{ project.phone }}</td>
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
                                    {{ formatDate(project.invoice_date) }}
                                </td>
                                <td>
                                    {{ getDueDate(project.invoice_date, 30) }}
                                </td>
                                <td>
                                    <!-- Tombol Invoice -->
                                    <div class="flex flex-col gap-1 mt-2">
                                        <!-- Kalau belum ada invoice_date -->
                                        <template v-if="!project.invoice_date">
                                            <Link :href="route('projects.send-invoice', project.id)" method="post">
                                                <n-button type="info" block>Kirim Invoice</n-button>
                                            </Link>
                                        </template>

                                        <!-- Kalau sudah ada invoice_date -->
                                        <template v-else-if="!project.is_paid">
                                            <Link :href="route('projects.send-invoice', project.id)" method="post">
                                                <n-button type="info" block>Kirim Ulang Invoice</n-button>
                                            </Link>
                                            <a :href="route('projects.invoice.view', project.id)" target="_blank">
                                                <n-button type="success" block>Lihat Invoice</n-button>
                                            </a>
                                            <a :href="route('projects.invoice.download', project.id)">
                                                <n-button type="warning" block>Download Invoice</n-button>
                                            </a>
                                            <Link
                                                :href="route('projects.mark-paid', project.id)"
                                                method="post"
                                                as="button"
                                            >
                                                <n-button type="primary" block>Lunas</n-button>
                                            </Link>
                                        </template>
                                        <template v-else>
                                            <n-button
                                                type="success"
                                                block
                                                disabled
                                            >
                                                Sudah Lunas
                                            </n-button>
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
