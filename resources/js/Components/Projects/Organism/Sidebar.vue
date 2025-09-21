<script setup>
import { 
    Home,
    List,
    ClipboardList,
    UserRegular,
} from '@vicons/fa';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <aside
        class="h-[100px] w-full flex bottom-0 items-center md:flex-col select-none md:h-[calc(100vh)] md:pt-[61px] px-1 text-center bg-white border-r md:w-[100px] fixed md:top-0 md:left-0 z-[900] overflow-y-auto custom-scroll-y-[2px]"
    >
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('projects.dashboard')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('projects.dashboard') ? 'bg-primary text-white' : ''"
                    >
                        <Home class="h-[21px]" />
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
                    :href="route('index.projects')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('index.projects') ? 'bg-primary text-white' : ''"
                    >
                        <List class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Projects</p>
                </Link>
            </template>
            Projects
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('projects.invoice')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('projects.invoice') ? 'bg-primary text-white' : ''"
                    >
                        <ClipboardList class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Invoices</p>
                </Link>
            </template>
            Invoices
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('projects.profile.edit')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('projects.profile.edit') ? 'bg-primary text-white' : ''"
                    >
                        <UserRegular class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Account</p>
                </Link>
            </template>
            Account
        </n-tooltip>
    </aside>
</template>