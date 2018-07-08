<template>
    <div class="control">
        <label class="control__label" :for="property.slug">{{ property.title }}</label>
        <textarea
               class="control__field"
               rows="4"
               :name="property.slug"
               :id="property.slug"
               :placeholder="'Input ' + property.title"
               v-model="property.value"></textarea>
    </div>
</template>

<script>
    export default {
        props: {
            property: {
                type: Object,
                required: true
            }
        }
    }
</script>
