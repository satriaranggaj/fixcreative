<script setup>
import GuestLayout from '@/Layouts/Projects/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


defineProps({
    status: {
        type: String,
    },
});

const formRef = ref(null);

const form = useForm({
    email: "",
});

const rules = {
    email: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('Email is required');
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                return new Error('Invalid email format');
            }

            return true;
        }
    },
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;

        form.post(route("password.email"));
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <n-form 
            ref="formRef" 
            @submit.prevent="submit"
            :model="form" 
            :rules="rules"
        >
            <n-form-item path="email" label="Email">
                <n-input
                    type="email"
                    size="large"
                    v-model:value="form.email"
                    placeholder="Email"
                />
            </n-form-item>

            <div class="flex items-center justify-end mt-4">
                <n-button
                    block
                    attr-type="submit"
                    type="primary"
                    :disabled="form.processing"
                    size="large"
                >
                    Email Password Reset Link
                </n-button>
            </div>
        </n-form>
    </GuestLayout>
</template>
