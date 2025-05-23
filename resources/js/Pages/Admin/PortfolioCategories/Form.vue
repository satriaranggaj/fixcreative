<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    portfolioCategory: Array
});

const formRef = ref(null);

const form = useForm({
    name: props.portfolioCategory?.name ?? '',
});

const rules = {
    name: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (_, value) => (value ? true : new Error('Name is required')),
    },
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;
        
        if (props.portfolioCategory) {
            form.post(route('update.portfolio-categories', { portfolioCategory: props.portfolioCategory.id }));
        } else {
            form.post(route('store.portfolio-categories'));
        }
    });
};
</script>
<template>
    <Head title="Portfolio Categories" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Form Portfolio Category</h1>
                </div>
                <n-card class="mt-4">
                    <n-form ref="formRef" :model="form" :rules="rules" @submit.prevent="submit">
                        
                        <n-form-item path="name" label="Name">
                            <n-input v-model:value="form.name" placeholder="Enter name" />
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
