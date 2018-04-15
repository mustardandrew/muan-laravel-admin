<template>
    <span>
        <a v-if="value" target="_blank" :href="value">{{ value }}</a>
    </span>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
