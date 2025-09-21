<script setup>
import AuthenticatedLayout from '@/Layouts/Projects/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    project: Object
});

const formRef = ref(null);

const form = useForm({
  client: props.project?.client ?? '',
  phone: props.project?.phone ?? '',
  email: props.project?.email ?? '',
  venue: props.project?.venue ?? '',
  address: props.project?.address ?? '',
  event_start: props.project?.event_start ?? null,
  event_end: props.project?.event_end ?? null,
  items: props.project?.items ?? [{ name: '', qty: 1, price: 0 }],
  payments: props.project?.payments ?? [
    { type: 'down_payment', amount: 0, payment_date: null, method: '' }
  ],
  description: props.project?.description ?? '',
});

const addPayment = () => {
  form.payments.push({ type: 'installment', amount: 0, payment_date: null, method: '' });
};

const removePayment = (index) => {
  form.payments.splice(index, 1);
};


const rules = {
    client: { required: true, validator: (_, v) => (v ? true : new Error('Client is required')) },
    phone: { required: true, validator: (_, v) => (v ? true : new Error('Phone is required')) },
    items: {
        validator: (_, v) => (v.length > 0 ? true : new Error('Minimal 1 item')),
    }
};

const addItem = () => {
    form.items.push({ name: '', qty: 1, price: 0 });
};

const removeItem = (index) => {
    form.items.splice(index, 1);
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;

        if (props.project) {
            console.log(form);
            form.post(route('update.projects', { project: props.project.id }));
        } else {
            console.log(form);
            form.post(route('store.projects'));
        }
    });
};
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Form Project</h1>
                </div>

                <n-card class="mt-4">
                    <n-form ref="formRef" :model="form" :rules="rules" @submit.prevent="submit">
                        <n-form-item path="client" label="Client">
                            <n-input v-model:value="form.client" placeholder="Nama Client" />
                        </n-form-item>

                        <n-form-item path="phone" label="Phone">
                            <n-input v-model:value="form.phone" placeholder="Nomor Telepon" />
                        </n-form-item>

                        <n-form-item path="email" label="Email">
                            <n-input v-model:value="form.email" placeholder="Alamat Email" />
                        </n-form-item>

                        <n-form-item path="venue" label="Venue">
                            <n-input v-model:value="form.venue" placeholder="Lokasi Acara" />
                        </n-form-item>

                        <n-form-item path="address" label="Address">
                            <n-input v-model:value="form.address" placeholder="Alamat Lengkap" />
                        </n-form-item>

                        <n-form-item path="event_start" label="Event Start">
                            <n-date-picker
                                v-model:formatted-value="form.event_start"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="Tanggal Mulai"
                            />
                        </n-form-item>

                        <n-form-item path="event_end" label="Event End">
                            <n-date-picker
                                v-model:formatted-value="form.event_end"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="Tanggal Selesai"
                            />
                        </n-form-item>
                        <!-- Items -->
                        <div class="border p-4 rounded-md mb-4">
                        <h2 class="font-semibold mb-2">Items</h2>
                        <div
                            v-for="(item, index) in form.items"
                            :key="index"
                            class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center mb-2"
                        >
                            <div class="md:col-span-5">
                            <n-input v-model:value="item.name" placeholder="Nama Paket" />
                            </div>
                            <div class="md:col-span-2">
                            <n-input-number v-model:value="item.qty" :min="1" placeholder="Day" />
                            </div>
                            <div class="md:col-span-3">
                            <n-input-number v-model:value="item.price" :min="0" placeholder="Harga" />
                            </div>
                            <div class="md:col-span-2 flex md:justify-end">
                            <n-button
                                type="error"
                                @click="removeItem(index)"
                                v-if="form.items.length > 1"
                                block
                            >
                                Hapus
                            </n-button>
                            </div>
                        </div>
                        <n-button type="primary" @click="addItem">Tambah Item</n-button>
                        </div>

                        <!-- Payments -->
                        <div class="border p-4 rounded-md mb-4">
                        <h2 class="font-semibold mb-2">Payments</h2>
                        <div
                            v-for="(payment, index) in form.payments"
                            :key="index"
                            class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center mb-2"
                        >
                            <div class="md:col-span-3">
                            <n-select
                                v-model:value="payment.type"
                                :options="[
                                { label: 'Down Payment', value: 'down_payment' },
                                { label: 'Installment', value: 'installment' },
                                { label: 'Final', value: 'final' }
                                ]"
                                placeholder="Jenis Pembayaran"
                            />
                            </div>
                            <div class="md:col-span-3">
                            <n-input-number v-model:value="payment.amount" :min="0" placeholder="Nominal" />
                            </div>
                            <div class="md:col-span-3">
                            <n-date-picker
                                v-model:formatted-value="payment.payment_date"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="Tanggal Bayar"
                            />
                            </div>
                            <div class="md:col-span-2">
                            <n-input v-model:value="payment.method" placeholder="Metode" />
                            </div>
                            <div class="md:col-span-1 flex md:justify-end">
                            <n-button
                                type="error"
                                @click="removePayment(index)"
                                v-if="form.payments.length > 1"
                                block
                            >
                                Hapus
                            </n-button>
                            </div>
                        </div>
                        <n-button type="primary" @click="addPayment">Tambah Payment</n-button>
                        </div>
                        <n-form-item path="description" label="Description">
                            <n-input
                                v-model:value="form.description"
                                type="textarea"
                                placeholder="Deskripsi tambahan"
                                rows="5"
                            />
                        </n-form-item>

                        <div class="flex justify-end">
                            <n-button attr-type="submit" type="primary" size="large" :disabled="form.processing">
                                Submit
                            </n-button>
                        </div>
                    </n-form>
                </n-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
