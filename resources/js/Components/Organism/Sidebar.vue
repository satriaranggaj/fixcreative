<script setup>
import {
    Plus, 
    Home,
    UserRegular
} from '@vicons/fa';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <aside
        class="select-none h-[calc(100vh)] pt-[61px] bg-white border-r w-[100px] hidden md:block fixed top-0 left-0 z-[900] overflow-y-auto custom-scroll-y-[2px]"
    >
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <div
                    class="w-full flex flex-col items-center py-5 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[38px] w-[38px] bg-primary shadow-sm shadow-primary-50 group-hover:-translate-y-[4px] duration-100 rounded-xl flex items-center justify-center"
                    >
                        <Plus class="text-white h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Website</p>
                </div>
            </template>
            Create Website
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('dashboard')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] flex items-center justify-center"
                    >
                        <Home class="text-primary h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Dashboard</p>
                </Link>
            </template>
            Dashboard
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('profile.edit')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] flex items-center justify-center"
                    >
                        <UserRegular class="text-primary h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Account</p>
                </Link>
            </template>
            Account
        </n-tooltip>
    </aside>
</template>