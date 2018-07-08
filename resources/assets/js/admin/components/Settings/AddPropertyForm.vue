<template>

    <form class="form" @submit.prevent="createProperty()">
        <h2>Add Property</h2>

        <div class="row">
            <div class="column two mr-20 mb-20">

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="slug">Slug</label>
                        <input type="text"
                               class="control__field"
                               name="slug"
                               id="slug"
                               placeholder="Input slug"
                               v-model="propertyFormData.slug" />
                        <span v-if="propertyFormErrors.slug" class="control__help control__help--error">
                            {{ propertyFormErrors.slug }}
                        </span>
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="title">Title</label>
                        <input type="text"
                               class="control__field"
                               name="title"
                               id="title"
                               placeholder="Input title"
                               v-model="propertyFormData.title" />
                        <span v-if="propertyFormErrors.title" class="control__help control__help--error">
                            {{ propertyFormErrors.title }}
                        </span>
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="type">Type</label>
                        <select class="control__field"
                                name="type"
                                id="type"
                                placeholder="Input type"
                                v-model="propertyFormData.type">
                            <option value="string">String</option>
                            <option value="boolean">Boolean</option>
                            <option value="text">Text</option>
                            <option value="integer">Integer</option>
                        </select>
                        <span v-if="propertyFormErrors.type" class="control__help control__help--error">
                            {{ propertyFormErrors.type }}
                        </span>
                    </div>
                </div>

                <div class=form__group>
                    <div class="control">
                        <label class="control__label" for="description">Description</label>
                        <textarea name="description"
                                  class="control__field"
                                  id="description"
                                  placeholder="Input description"
                                  cols="30"
                                  rows="5" v-model="propertyFormData.description"></textarea>
                        <span v-if="propertyFormErrors.description" class="control__help control__help--error">
                            {{ propertyFormErrors.description }}
                        </span>
                    </div>
                </div>

            </div>
            <div class="column mb-20">

            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Create
            </button>
        </div>

    </form>

</template>

<script>
    import * as header from '../../store/modules/settings/header';

    export default {

        computed: {
            propertyFormData() {
                return this.$store.getters['settings/propertyFormData'];
            },
            propertyFormErrors() {
                return this.$store.getters['settings/propertyFormErrors'];
            }
        },

        methods: {
            createProperty() {
                this.$store.dispatch(`settings/${header.SETTINGS_FORM_PROPERTY_SEND_ACTION}`);
            }
        }
    };
</script>
