<style>
    .link-source {
        color: #3d4957;
        text-decoration: none;
    }
    .link-source:hover {
        text-decoration: underline;
    }
    .link-source i {
        font-size: 11px;
    }
</style>

<template>
    <span v-if="value">
        <a class="link-source" :href="value" target="_blank">
            Source
            <i class="fas fa-external-link-alt"></i>
        </a>
    </span>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
