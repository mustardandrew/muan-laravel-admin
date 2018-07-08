<template>

    <div class="control">
        <label class="control__label" :for="property.slug">{{ property.title }}</label>
        <input type="text"
               class="control__field"
               :name="property.slug"
               :id="property.slug"
               :placeholder="'Input ' + property.title"
               v-model="property.value" />
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
