<script setup>
import AppStore from '@/stores/ApplicationStore.js';
import ApplicationLogo from '@/Components/Projects/Atoms/ApplicationLogo.vue';
import AppMessageListener from '@/Components/Projects/Organism/AppMessageListener.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <n-config-provider 
        :theme="AppStore.theme"
        :themeOverrides="AppStore.themeOverrides"    
    >
        <n-spin :show="AppStore.loadingStack > 0">
            <n-message-provider :max="3" placement="top">
                <n-dialog-provider>
                    <AppMessageListener>
                        <div
                            class="flex min-h-screen flex-col items-center bg-gray-100 justify-center"
                        >
                            <div>
                                <Link href="/">
                                    <ApplicationLogo class="h-20 fill-current text-gray-500" />
                                </Link>
                            </div>

                            <div
                                class="mt-6 w-[90%] rounded-lg overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md"
                            >
                                <slot />
                            </div>
                        </div>
                    </AppMessageListener>
                </n-dialog-provider>
            </n-message-provider>
        </n-spin>
    </n-config-provider>
</template>
