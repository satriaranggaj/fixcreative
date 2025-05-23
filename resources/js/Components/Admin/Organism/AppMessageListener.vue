<script setup>
import { computed, watch } from "vue";
import { useMessage } from "naive-ui";
import { usePage } from "@inertiajs/vue3";

const flashMessage = computed(() => usePage().props.flash.message);
const errors = computed(() => usePage().props.errors);

const message = useMessage();

watch(
    () => flashMessage.value,
    () => {
        if (flashMessage.value && flashMessage.value.length) {
            flashMessage.value.forEach((item) => {
                message[item[0]](item[1]);
            });
        }
    },
    {
        immediate: true,
    }
);

watch(
    () => errors.value,
    () => {
        for (let key in errors.value) {
            message.error(errors.value[key]);
        }
    }
);
</script>

<template>
    <slot></slot>
</template>
