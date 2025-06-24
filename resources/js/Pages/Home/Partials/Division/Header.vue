<script setup>
</script>
<template>
    <header class="pt-5 mt-12 bg-primary-300 relative flex items-center">
        <div>
            <img src="img/division/division.webp" alt="header-image">
        </div>
    </header>
</template>
<style scoped>

div {
    border-radius: 0 2vw 2vw 0;
    overflow: hidden;
    width: 100%;
    min-height: 75px;
    aspect-ratio: 6/1.5;
    object-fit: cover;
    object-position: bottom;
    transform: skewX(-20deg) translateX(-10%) translateY(10%);
}
img {
    transform: skewX(20deg) translateX(15%) translateY(-50%);
}
</style>