<script setup>
import { 
    Home,
    NewspaperRegular,
    List,
    ImagesRegular,
    IdCardRegular,
    UserRegular,
} from '@vicons/fa';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <aside
        class="select-none h-[calc(100vh)] pt-[61px] px-1 text-center bg-white border-r w-[100px] hidden md:block fixed top-0 left-0 z-[900] overflow-y-auto custom-scroll-y-[2px]"
    >
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
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('dashboard') ? 'bg-primary text-white' : ''"
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
                    :href="route('index.articles')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('index.articles') ? 'bg-primary text-white' : ''"
                    >
                        <NewspaperRegular class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Articles</p>
                </Link>
            </template>
            Articles
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('index.article-categories')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('index.article-categories') ? 'bg-primary text-white' : ''"
                    >
                        <List class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Article Categories</p>
                </Link>
            </template>
            Article Categories
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('index.portfolios')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('index.portfolios') ? 'bg-primary text-white' : ''"
                    >
                        <ImagesRegular class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Porfolios</p>
                </Link>
            </template>
            Porfolios
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('index.portfolio-categories')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('index.portfolio-categories') ? 'bg-primary text-white' : ''"
                    >
                        <List class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Portfolio Categories</p>
                </Link>
            </template>
            Portfolio Categories
        </n-tooltip>
        <n-tooltip
            triger="hover"
            placement="right"
        >
            <template #trigger>
                <Link
                    :href="route('index.careers')"
                    class="w-full flex flex-col items-center py-3 cursor-pointer group gap-2"
                >
                    <div
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('index.careers') ? 'bg-primary text-white' : ''"
                    >
                        <IdCardRegular class="h-[21px]" />
                    </div>

                    <p class="font-medium text-xs">Careers</p>
                </Link>
            </template>
            Careers
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
                        class="h-[34px] w-[38px] rounded-md flex items-center justify-center text-primary hover:text-white hover:bg-primary transition-all duration-300"
                        :class="route().current('profile.edit') ? 'bg-primary text-white' : ''"
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