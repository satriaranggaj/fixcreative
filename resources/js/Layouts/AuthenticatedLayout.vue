<script setup>
import AppStore from '@/stores/ApplicationStore.js';
import Navbar from '@/Components/Admin/Organism/Navbar.vue';
import Sidebar from '@/Components/Admin/Organism/Sidebar.vue';
import AppMessageListener from '@/Components/Admin/Organism/AppMessageListener.vue';
</script>

<template>
    <n-config-provider 
        :theme="AppStore.theme" 
        :theme-overrides="AppStore.themeOverrides" 
    >
        <n-spin :show="AppStore.loadingStack > 0">
            <n-message-provider :max="3" placement="top">
                <n-dialog-provider>
                    <AppMessageListener>
                        <Navbar />
                        <div class="mt-16">
                            <Sidebar />
                            <div class="min-h-screen ml-[100px] bg-gray-100">
                                <!-- Page Content -->
                                <main>
                                    <slot />
                                </main>
                            </div>
                        </div>
                    </AppMessageListener>
                </n-dialog-provider>
            </n-message-provider>
        </n-spin>
    </n-config-provider>
</template>
