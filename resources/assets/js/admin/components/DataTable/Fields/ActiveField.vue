<template>
    <span>
        {{ value ? 'Yes' : 'No' }}
    </span>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
