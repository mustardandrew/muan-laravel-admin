<template>
    <div>
        <edit-group-form v-if="showEditGroupForm"></edit-group-form>

        <div v-else class="group-block">
            <h2>
                {{ group.title }}
                <span class="group-slug">({{ group.slug }})</span>
            </h2>
            <div class="group-description" v-if="group.description">{{ group.description }}</div>

            <div class="block-actions">
                <span class="action action--edit" title="Edit Group" @click="editGroup()">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="action action--destroy" title="Destroy Group" @click="destroyGroup()">
                    <i class="fa-times fas"></i>
                </span>
            </div>

            <form class="form" v-if="group.properties" @submit.prevent="">
                <div class="form__group property-block" v-for="property in group.properties">
                    <component v-bind:is="property.type + 'Type'" :property="property" :group-slug="group.slug"></component>

                    <div class="block-actions">
                        <span class="action action--destroy" :title="'Destroy ' + property.title + ' property'" @click="destroyProperty(property)">
                            <i class="fa-times fas"></i>
                        </span>
                    </div>
                </div>
            </form>

            <span class="add-new-property mt-10" @click="toggleForm()">
                {{ showAddPropertyForm ? '-' : '+' }} new property
            </span>
            <add-property-form v-if="showAddPropertyForm"></add-property-form>
        </div>
    </div>
</template>

<script>
    import * as header from '../../store/modules/settings/header';

    import EditGroupForm from './EditGroupForm';
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
            showEditGroupForm() {
                return this.$store.getters['settings/showEditGroupForm'];
            }
        },

        components: {
            EditGroupForm,
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
            editGroup() {
                this.$store.commit(`settings/${header.SETTINGS_SHOW_EDIT_GROUP_FORM_MUTATION}`);
            },
            toggleForm() {
                this.$store.commit(`settings/${header.SETTINGS_TOGGLE_PROPERTY_FORM_MUTATION}`);
            },
            destroyProperty(property) {
                this.$store.dispatch(`settings/${header.SETTINGS_DESTROY_PROPERTY_ACTION}`, property);
            }
        }
    }
</script>
