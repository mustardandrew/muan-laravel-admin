<template>
    <form class="form" @submit.prevent="updateGroup()">
        <h2>Edit Group</h2>

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
                               v-model="groupFormData.slug"/>
                        <span v-if="groupFormErrors.slug" class="control__help control__help--error">
                                {{ groupFormErrors.slug }}
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
                               v-model="groupFormData.title" />
                        <span v-if="groupFormErrors.title" class="control__help control__help--error">
                                {{ groupFormErrors.title }}
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
                                  rows="5"
                                  v-model="groupFormData.description"></textarea>
                        <span v-if="groupFormErrors.description" class="control__help control__help--error">
                                {{ groupFormErrors.description }}
                        </span>
                    </div>
                </div>

            </div>
            <div class="column mb-20">

            </div>
        </div>

        <div class=form__group>
            <button type="submit" class="button button--dark mr-5">
                Update
            </button>
            <button type="button" class="button mr-5" @click="cancelForm()">
                Cancel
            </button>
        </div>

    </form>
</template>

<script>
    import * as header from '../../store/modules/settings/header';

    export default {

        mounted() {
            let currentItem = this.$store.getters['settings/currentItem'];

            this.groupFormData.slug = currentItem.slug;
            this.groupFormData.title = currentItem.title;
            this.groupFormData.description = currentItem.description;
        },

        computed: {
            groupFormData() {
                return this.$store.getters['settings/groupFormData'];
            },
            groupFormErrors() {
                return this.$store.getters['settings/groupFormErrors'];
            }
        },

        methods: {
            updateGroup() {
                this.$store.dispatch(`settings/${header.SETTINGS_EDIT_FORM_GROUP_ACTION}`);
            },
            cancelForm() {
                this.$store.commit(`settings/${header.SETTINGS_HIDE_EDIT_GROUP_FORM_MUTATION}`);
            }
        }
    }
</script>
