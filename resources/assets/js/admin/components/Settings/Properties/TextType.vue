<template>
    <div class="control">
        <label class="control__label" :for="property.slug">
            {{ property.title }}
            <span class="property-slug">({{ groupSlug }}.{{ property.slug }})</span>
        </label>

        <div class="property-description" v-if="property.description">{{ property.description }}</div>

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
            },
            groupSlug: {
                type: String,
                required: true,
            }
        }
    }
</script>
