<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/Projects/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const formRef = ref(null);

const form = useForm({
    password: '',
});

const rules = {
    password: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('Password is required');
            }

            return true;
        }
    },
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;
        
        form.post(route('password.confirm'));
    })
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <n-form 
            size="large"
            ref="formRef"
            :rules="rules"
            :model="form"
            @submit.prevent="submit"
        >
            <n-form-item path="password" label="Password">
                <n-input
                    type="password"
                    size="large"
                    v-model:value="form.password"
                    show-password-on="click"
                    placeholder="Password"
                    autocomplete="current-password"
                />
            </n-form-item>

            <div class="mt-4 flex justify-end">
                <n-button
                    attr-type="submit"
                    size="large"
                    type="primary" 
                    :disabled="form.processing"
                >
                    Konfirmasi
                </n-button>
            </div>
        </n-form>
    </GuestLayout>
</template>
