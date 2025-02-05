<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const formRef = ref(null);

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
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
    password_confirmation: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('Password confirmation is required');
            }
            if (value !== form.password) {
                return new Error('Passwords do not match');
            }

            return true;
        }
    },
};
const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;

        form.post(route('password.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

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
                    autocomplete="new-password"
                />
            </n-form-item>

            <n-form-item path="password_confirmation" label="Confirm Password">
                <n-input
                    type="password"
                    size="large"
                    v-model:value="form.password_confirmation"
                    show-password-on="click"
                    placeholder="Confirm Password"
                    autocomplete="new-password"
                />
            </n-form-item>

            <div class="flex items-center justify-end mt-4">
                <n-button
                    attr-type="submit"
                    :disabled="form.processing"
                    type="primary"
                    size="large"
                >
                    Reset Password
                </n-button>
            </div>
        </n-form>
    </GuestLayout>
</template>
