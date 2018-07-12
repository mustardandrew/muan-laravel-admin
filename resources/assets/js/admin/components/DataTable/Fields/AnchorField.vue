<style>
    .link-source {
        color: #3d4957;
        text-decoration: none;
    }
    .link-source:hover {
        text-decoration: underline;
    }
</style>

<template>
    <span>
        <a v-if="value.link" class="link-source" :href="value.link">
            <span v-if="value.text">{{ value.text }}</span>
        </a>
    </span>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
