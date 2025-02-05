<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/Atoms/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { NButton } from 'naive-ui';

const showingNavigationDropdown = ref(false);
</script>
<template>
    <nav
        class="fixed top-0 z-[1000] w-full border-b border-gray-100 bg-white"
    >
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-[95%]">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center mr-4">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>

                    <h1 class="text-xl font-black text-primary">
                        APP Page Builder
                    </h1>
                </div>

                <div class="button-logout">
                    <n-button 
                        @click="$inertia.post(route('logout'))"
                        round
                    >
                        Log Out
                    </n-button>
                </div>
            </div>
        </div>
    </nav>
</template>