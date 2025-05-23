<script setup>
import AppStore from '@/stores/ApplicationStore.js';
import Navbar from '@/Components/Home/Organism/Navbar.vue';
import AppMessageListener from '@/Components/Home/Organism/AppMessageListener.vue';
import Footer from '@/Components/Home/Organism/Footer.vue';
</script>

<template>
    <n-config-provider 
        :theme="AppStore.theme" 
        :theme-overrides="AppStore.themeOverrides" 
        class="bg-gray-100"
    >
        <n-spin :show="AppStore.loadingStack > 0">
            <n-message-provider :max="3" placement="top">
                <n-dialog-provider>
                    <AppMessageListener>
                        <Navbar />
                        <div class="overflow-hidden">
                            <div class="min-h-screen">
                                <!-- Page Content -->
                                <main>
                                    <slot />
                                </main>
                            </div>
                        </div>
                        <Footer />
                    </AppMessageListener>
                </n-dialog-provider>
            </n-message-provider>
        </n-spin>
    </n-config-provider>
</template>
