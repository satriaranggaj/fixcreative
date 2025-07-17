<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    portfolio_categories: Array,
    portfolio: Object
});

const formRef = ref(null);
const editor = ref(null);

const form = useForm({
    image: props.portfolio?.image
        ? props.portfolio.image.map(img => ({
            url: '/storage/' + img,
            name: img.split('/').pop(),
            type: 'image/*',
            status: 'finished',
        }))
        : [],
    portfolio_category_id: props.portfolio?.portfolio_category_id ?? null,
    title: props.portfolio?.title ?? '',
    content: props.portfolio?.content ?? '',
});

const formattedPortfolioCategories = computed(() => {
    return props.portfolio_categories?.map(category => ({
        label: category.name,
        value: category.id
    })) || [];
});

const rules = {
    image: {
        trigger: ['input', 'blur', 'change'],
        required: true,
        validator(rule, value) {
            if (!value || value.length === 0) {
                return Promise.reject(new Error("Minimal 1 gambar harus dipilih"));
            }

            for (const file of value) {
                if (!/image\/.*/.test(file.type)) {
                    return Promise.reject(new Error("Semua file harus bertipe gambar"));
                }
            }

            return Promise.resolve();
        },
    },
    portfolio_category_id: {
        required: true,
        validator: (_, value) => value ? true : new Error('Portfolio category is required'),
    },
    title: {
        required: true,
        validator: (_, value) => value ? true : new Error('Title is required'),
    },
    content: {
        required: true,
        validator: (_, value) => {
            const plainText = value ? value.replace(/<[^>]*>?/gm, '').trim() : '';
            return plainText.length > 0 ? true : new Error('Content is required');
        },
    }
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;

        const routeName = props.portfolio
            ? route('update.portfolios', { portfolio: props.portfolio.slug })
            : route('store.portfolios');

        form.post(routeName);
    });
};

// ✅ Lazy load CKEditor agar tidak menurunkan performa halaman
const loadScript = (src) => {
    return new Promise((resolve, reject) => {
        if (window.CKEDITOR) return resolve();
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
    });
};

onMounted(async () => {
    await loadScript('/libraries/ckeditor/ckeditor.js');

    try {
        editor.value = CKEDITOR.replace('content', {
            removePlugins: 'versionCheck',
            width: '100%',
            height: 300,
            notification: { duration: 0 },
        });

        editor.value.on('change', () => {
            form.content = editor.value.getData();
            formRef.value?.validate();
        });

        editor.value.on('instanceReady', () => {
            if (form.content) {
                editor.value.setData(form.content);
            }
        });
    } catch (error) {
        console.error('CKEditor initialization failed:', error);
    }
});

onBeforeUnmount(() => {
    if (editor.value) {
        try {
            editor.value.destroy();
        } catch (error) {
            console.error('CKEditor cleanup failed:', error);
        }
        editor.value = null;
    }
});
</script>

<template>
    <Head title="portfolios" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Form Portfolio</h1>
                </div>
                <n-card class="mt-4">
                    <n-form ref="formRef" :model="form" :rules="rules" @submit.prevent="submit">
                        <n-form-item path="image" label="Image">
                            <n-upload
                                :default-upload="false"
                                accept="image/*"
                                list-type="image-card"
                                multiple
                                :file-list="form.image"
                                @update:file-list="files => form.image = files"
                                name="image"
                            />
                        </n-form-item>

                        <n-form-item path="portfolio_category_id" label="Portfolio Category">
                            <n-select v-model:value="form.portfolio_category_id" :options="formattedPortfolioCategories" />
                        </n-form-item>

                        <n-form-item path="title" label="Title">
                            <n-input v-model:value="form.title" placeholder="Enter title" />
                        </n-form-item>
                        
                        <n-form-item path="content" label="Content">
                            <textarea v-model="form.content" name="content" id="content" cols="30" rows="10" class="ckeditor"></textarea>
                        </n-form-item>

                        <div class="flex justify-end">
                            <n-button attr-type="submit" type="primary" size="large" :disabled="form.processing">
                                Submit
                            </n-button>
                        </div>
                    </n-form>
                </n-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>