<script setup>
import appStore from '@/stores/ApplicationStore.js';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const formRef = ref(null);

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const rules = {
    name: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        vlidator: (rule, value) => {
            if(!value) {
                return new Error('Name is required.');
            }

            return true;
        }
    },
    email: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if(!value) {
                return new Error('Email is required.');
            }
            if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                return new Error('Invalid email format');
            }

            return true;
        }
    },
};

const submit = () => {
    appStore.increaseLoadingStack();
    formRef.value?.validate((errors) => {
        if (errors) return;

        form.patch(route('profile.update'), {
            preserveScroll: true,
            onFinish:() => {
                appStore.decreaseLoadingStack();
            },
            onError: () => {},
        });
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>

            <p class="mt-1 mb-6 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <n-form
            ref="formRef"
            @submit.prevent="submit"
            :model="form"
            :rules="rules"
        >
            <n-form-item path="name" label="Name">
                <n-input
                    type="text"
                    size="large"
                    v-model:value="form.name"
                />
            </n-form-item>

            <n-form-item path="email" label="Email">
                <n-input
                    type="email"
                    size="large"
                    v-model:value="form.email"
                    disabled
                />
            </n-form-item>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <n-button
                    attr-type="submit"
                    type="primary"
                    size="large"
                    :disabled="form.processing"
                >
                    Save
                </n-button>
            </div>
        </n-form>
    </section>
</template>
