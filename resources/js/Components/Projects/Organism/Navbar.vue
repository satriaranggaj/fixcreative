<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/Admin/Atoms/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { NButton } from 'naive-ui';

const showingNavigationDropdown = ref(false);
</script>
<template>
    <nav
        class="fixed top-0 z-[1000] w-full px-24 border-b border-gray-100 bg-white"
    >
        <!-- Primary Navigation Menu -->
        <div class="mx-auto w-full">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center mr-4">
                        <Link :href="route('projects.dashboard')">
                            <ApplicationLogo
                                class="block h-12 w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>
                </div>

                <div class="button-logout">
                    <n-button 
                        @click="$inertia.post(route('projects.logout'))"
                        round
                    >
                        Log Out
                    </n-button>
                </div>
            </div>
        </div>
    </nav>
</template>