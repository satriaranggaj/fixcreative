<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    articleCategory: Array
});

const formRef = ref(null);

const form = useForm({
    name: props.articleCategory?.name ?? '',
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
        
        if (props.articleCategory) {
            form.post(route('update.article-categories', { articleCategory: props.articleCategory.id }));
        } else {
            form.post(route('store.article-categories'));
        }
    });
};
</script>
<template>
    <Head title="Articles Categories" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Form Article Category</h1>
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
