<style scoped>
    .image-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-wrapper img {
        height: 32px;
    }
</style>

<template>
    <div class="image-wrapper">
        <img :src="value.src" alt="" :style="value.style" :class="value.class" />
    </div>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
