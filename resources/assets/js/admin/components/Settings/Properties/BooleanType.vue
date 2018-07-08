<template>

    <div class="control">
        <input type="checkbox"
               class="control__field"
               :ame="property.slug"
               :id="property.slug"
               true-value="1"
               false-value="0"
               :placeholder="'Input ' + property.title"
               v-model="property.value"/>
        <label class="control__label" :for="property.slug">{{ property.title }}</label>
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
