<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    career: Object
});

const formRef = ref(null);
const editor = ref(null);

const categoryOptions = [
    { label: 'Full Time', value: 'full_time' },
    { label: 'Part Time', value: 'part_time' },
    { label: 'Full Time & Part Time', value: 'both' },
];

const form = useForm({
    title: props.career?.title ?? '',
    category: props.career?.category ?? '',
    description: props.career?.description ?? '',
    responsibilities: props.career?.responsibilities ?? '',
    criteria: props.career?.criteria ?? '',
});

const rules = {
    title: {
        trigger: ['change', 'blur', 'input'],
        required: true,
        validator: (_, value) => (value ? true : new Error('Title is required')),
    },
    category: {
        required: true,
        validator: (_, value) => (value ? true : new Error('Category is required')),
    },
};

const submit = () => {
    formRef.value?.validate((errors) => {
        if (errors) return;

        if (props.career) {
            form.post(route('update.careers', { career: props.career.id }));
        } else {
            form.post(route('store.careers'));
        }
    });
};

// CKEditor init
onMounted(() => {
    const fields = ['description', 'responsibilities', 'criteria'];

    fields.forEach((field) => {
        try {
            const instance = CKEDITOR.replace(field, {
                removePlugins: 'versionCheck',
                width: '100%',
                height: 300,
                notification: { duration: 0 },
            });

            instance.on('change', function () {
                form[field] = instance.getData();
            });

            instance.on('instanceReady', function () {
                if (form[field]) {
                    instance.setData(form[field]);
                }
            });
        } catch (error) {
            console.error(`CKEditor init failed on ${field}:`, error);
        }
    });
});

onBeforeUnmount(() => {
    for (const name in CKEDITOR.instances) {
        CKEDITOR.instances[name].destroy();
    }
});
</script>

<template>
    <Head title="careers" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-[90%]">
                <div class="flex items-center justify-between px-4">
                    <h1 class="text-2xl font-bold">Form Career</h1>
                </div>

                <n-card class="mt-4">
                    <n-form ref="formRef" :model="form" :rules="rules" @submit.prevent="submit">
                        <n-form-item path="title" label="Title">
                            <n-input v-model:value="form.title" placeholder="Enter title" />
                        </n-form-item>

                        <n-form-item path="category" label="Category">
                            <n-select
                                v-model:value="form.category"
                                :options="categoryOptions"
                                placeholder="Pilih kategori"
                            />
                        </n-form-item>

                        <n-form-item path="description" label="Description">
                            <textarea v-model="form.description" name="description" id="description" cols="30" rows="10" class="ckeditor"></textarea>
                        </n-form-item>

                        <n-form-item path="responsibilities" label="Responsibilities">
                            <textarea v-model="form.responsibilities" name="responsibilities" id="responsibilities" cols="30" rows="10" class="ckeditor"></textarea>
                        </n-form-item>

                        <n-form-item path="criteria" label="Criteria">
                            <textarea v-model="form.criteria" name="criteria" id="criteria" cols="30" rows="10" class="ckeditor"></textarea>
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
