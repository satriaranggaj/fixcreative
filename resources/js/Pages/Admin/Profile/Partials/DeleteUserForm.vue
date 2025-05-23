<script setup>
import { router } from '@inertiajs/vue3';
import appStore from '@/stores/ApplicationStore.js';
import { useDialog } from 'naive-ui';

const dialog = useDialog();

const deleteUser = () => {
    dialog.warning({
        title: 'Delete Account',
        content: 'Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
        positiveText: 'Delete',
        negativeText: 'Cancel',
        onPositiveClick: () => {
            appStore.decreaseLoadingStack();
            router.delete(route('profile.destroy'), {
                preserveScroll: true,
                onFinish: () => appStore.decreaseLoadingStack(),
            });
        },
        onNegativeClick: () => {},
    });
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Delete Account
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </p>
        </header>

        <n-button
            type="error"
            size="large"
            @click="deleteUser"
        >
            Delete Account
        </n-button>
    </section>
</template>
