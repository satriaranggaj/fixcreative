<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    article_categories: Array,
    article: Object
});

const formRef = ref(null);
const editor = ref(null);

const form = useForm({
    image: props.article?.image
    ? {
        url: '/storage/' + props.article.image,
        name: props.article.image.split('/').pop(),
        type: '/image\/.*/',
        status: 'finished',
    } : null,
    article_category_id: props.article?.article_category_id ?? null,
    title: props.article?.title ?? '',
    content: props.article?.content ?? '',
});


const formatedArticleCategories = computed(() => {
    return props.article_categories?.map((category) => ({
        label: category.name,
        value: category.id
    })) || [];
});

const rules = {
    image: {
        trigger: ["input", "blur", "change"],
        required: true,
        validator(rule, value) {
            if (!value) return Promise.reject(new Error("Image is required"));
            if (!/image\/.*/.test(value.type)) return Promise.reject(new Error("File type must be an image"));
            return Promise.resolve();
        },
    },
    article_category_id: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (_, value) => (value ? true : new Error('Article category is required')),
    },
    title: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (_, value) => (value ? true : new Error('Title is required')),
    },
    content: {
        trigger: ['change', 'blur', 'input'],
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

        if (props.article) {
            form.post(route('update.articles', { article: props.article.id }));
        } else {
            form.post(route('store.articles')); 
        }
    });
};


onMounted(async () => {
    if (!window.CKEDITOR) {
        await loadScript('/libraries/ckeditor/ckeditor.js');
    }

    if (window.CKEDITOR) {
        editor.value = CKEDITOR.replace('content', {
            removePlugins: 'versionCheck',
            width: '100%',
            height: 300,
            notification: { duration: 0 },
            on: {
                change: function () {
                    form.content = editor.value.getData();
                    formRef.value?.validate();
                },
                instanceReady: function () {
                    if (form.content) {
                        editor.value.setData(form.content);
                    }
                }
            }
        });
    }
});

const loadScript = (src) => {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
    });
};


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
    <Head title="Articles" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Form Articles</h1>
                </div>
                <n-card class="mt-4">
                    <n-form ref="formRef" :model="form" :rules="rules" @submit.prevent="submit">
                        <n-form-item path="image" label="Image">
                            <n-upload
                                :default-upload="false"
                                :max="1"
                                accept="image/*"
                                list-type="image-card"
                                :file-list="form.image ? [form.image] : []"
                                @update:file-list="files => form.image = files.length ? files[0] : null"
                                name="image"
                            />
                        </n-form-item>

                        <n-form-item path="article_category_id" label="Article Category">
                            <n-select v-model:value="form.article_category_id" :options="formatedArticleCategories" />
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