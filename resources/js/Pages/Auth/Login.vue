<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const formRef = ref(null);

const form = useForm({
    email: '',
    password: '',
    remember: false,
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
        }
    },
    password: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('Password is required');
            }
        }
    }
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;

        form.post(route('login'), {
            onFinish: () => form.reset('password', 'remember'),
        });
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
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
                    autocomplete="email"
                />
            </n-form-item>

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

            <div class="flex items-center justify-between mb-5">
                <label class="flex items-center">
                    <n-checkbox v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Forgot your password?
                </Link>
            </div>
            <n-button
                block
                attr-type="submit" 
                type="primary"
                size="large"
                :disabled="form.processing"
            >
                Log in
            </n-button>
            <p class="mt-5 text-center">
                Don't have an account?
                <Link
                    :href="route('register')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Register
                </Link>
            </p>
        </n-form>
    </GuestLayout>
</template>
