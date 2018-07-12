<template>
    <div class="group-block">
        <h2>{{ group.title }}</h2>
        <p v-if="group.description">{{ group.description }}</p>

        <div class="block-actions">
            <span class="action action--destroy" title="Destroy Group" @click="destroyGroup()">
                <i class="fa-times fas"></i>
            </span>
        </div>

        <form class="form" v-if="group.properties" @submit.prevent="">
            <div class=form__group v-for="property in group.properties">
                <component v-bind:is="property.type + 'Type'" :property="property"></component>

                <span class="action action--destroy" title="Destroy Property" @click="destroyProperty(property)">
                    <i class="fa-times fas"></i>
                </span>
            </div>
        </form>

        <span class="add-new-property mt-10" @click="toggleForm()">
            {{ showAddPropertyForm ? '-' : '+' }} new property
        </span>
        <add-property-form v-if="showAddPropertyForm"></add-property-form>
    </div>
</template>

<script>
    import * as header from '../../store/modules/settings/header';

    import AddPropertyForm from './AddPropertyForm';

    import IntegerType from './Properties/IntegerType';
    import StringType from './Properties/StringType';
    import TextType from './Properties/TextType';
    import BooleanType from './Properties/BooleanType';

    export default {
        props: {
            group: {
                type: Object,
                required: true
            }
        },

        computed: {
            showAddPropertyForm() {
                return this.$store.getters['settings/showAddPropertyForm'];
            },
        },

        components: {
            AddPropertyForm,
            IntegerType,
            TextType,
            StringType,
            BooleanType
        },

        methods: {
            destroyGroup() {
                this.$store.dispatch(`settings/${header.SETTINGS_DESTROY_GROUP_ACTION}`, this.group);
            },
            toggleForm() {
                this.$store.commit(`settings/${header.SETTINGS_TOGGLE_PROPERTY_FORM_MUTATION}`);
            },
            destroyProperty(property) {
                this.$store.dispatch(`settings/${header.SETTINGS_DESTROY_PROPERTY_ACTION}`, property);
                // this.$forceUpdate();
            }
        }
    }
</script>
