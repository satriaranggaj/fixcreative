<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};

const rules = {
    current_password: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('Current password is required.');
            }
            return true;
        }
    },
    password: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('New password is required.');
            }
            return true;
        }
    },
    password_confirmation: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (rule, value) => {
            if (!value) {
                return new Error('New password confirmation is required.');
            }
            if (value !== form.password) {
                return new Error('New password confirmation does not match.');
            }
            
            return true;
        }
    },
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Update Password
            </h2>

            <p class="mt-1 mb-6 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </header>

        <n-form
            ref="formRef"
            @submit.prevent="updatePassword"
            :model="form"
            :rules="rules"
        >
            <div>
                <n-form-item
                    path="current_password"
                    label="Current Password"
                >
                    <n-input
                        v-model:value="form.current_password"
                        size="large"
                        ref="currentPasswordInput"
                        type="password"
                        show-password-on="click"
                    />
                </n-form-item>

                <n-form-item path="password" label="New Password">
                    <n-input
                        v-model:value="form.password"
                        size="large"
                        ref="passwordInput"
                        type="password"
                        show-password-on="click"
                    />
                </n-form-item>

                <n-form-item
                    path="password_confirmation"
                    label="Confirm Password"
                >
                    <n-input
                        v-model:value="form.password_confirmation"
                        size="large"
                        type="password"
                        show-password-on="click"
                    />
                </n-form-item>
            </div>

            <div class="flex items-center">
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
