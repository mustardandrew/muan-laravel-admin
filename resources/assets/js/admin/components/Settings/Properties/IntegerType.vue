<template>

    <div class="control">
        <label class="control__label" :for="property.slug">
            {{ property.title }}
            <span class="property-slug">({{ groupSlug }}.{{ property.slug }})</span>
        </label>

        <div class="property-description" v-if="property.description">{{ property.description }}</div>

        <input type="number"
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
            },
            groupSlug: {
                type: String,
                required: true,
            }
        }
    }
</script>
