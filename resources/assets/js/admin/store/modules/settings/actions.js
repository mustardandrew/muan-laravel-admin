import * as header from './header';

const actions = {

    // Get all groups
    async [header.SETTINGS_FETCH_ITEMS_ACTION] ({commit, state}) {
        try {
            let url = state.config.listRoute;
            let { data } = await window.axios.get(url);

            commit(header.SETTINGS_SET_ITEMS_MUTATION, data);
        } catch (error) {
            console.log(error);
        }
    },

    // Create new Group
    async [header.SETTINGS_FORM_GROUP_SEND_ACTION] ({commit, state}) {
        try {
            commit(header.SETTINGS_GROUP_FORM_CLEAR_ERRORS_MUTATION);

            let formData = state.groupFormData;
            let url = state.config.addGroupRoute;

            let {data} = await window.axios.post(url, formData);
            commit(header.SETTINGS_ADD_ITEM_MUTATION, data.group);
            commit(header.SETTINGS_GROUP_FORM_CLEAR_MUTATION);

        } catch (error) {

            if (error.response.status === 422) {

                let errors = error.response.data.errors;

                commit(header.SETTINGS_GROUP_FORM_SET_ERRORS_MUTATION, {
                    slug: errors.slug ? errors.slug[0] : '',
                    title: errors.title ? errors.title[0] : '',
                    description: errors.description ? errors.description[0] : ''
                });

            } else {
                console.log(error);
            }

        }
    },

    async [header.SETTINGS_EDIT_FORM_GROUP_ACTION] ({commit, dispatch, state}) {
        try {
            commit(header.SETTINGS_GROUP_FORM_CLEAR_ERRORS_MUTATION);

            let url = state.config.editGroupRoute;

            let formData = state.groupFormData;
            formData.id = state.currentItem.id;

            let {data} = await window.axios.post(url, formData);

            commit(header.SETTINGS_UPDATE_ITEM_MUTATION, data.group);
            commit(header.SETTINGS_GROUP_FORM_CLEAR_MUTATION);
            commit(header.SETTINGS_HIDE_EDIT_GROUP_FORM_MUTATION);
        } catch (error) {

            if (error.response.status === 422) {

                let errors = error.response.data.errors;

                commit(header.SETTINGS_GROUP_FORM_SET_ERRORS_MUTATION, {
                    slug: errors.slug ? errors.slug[0] : '',
                    title: errors.title ? errors.title[0] : '',
                    description: errors.description ? errors.description[0] : ''
                });

            } else {
                console.log(error);
            }

        }
    },

    async [header.SETTINGS_DESTROY_GROUP_ACTION] ({commit, state}, item) {
        try {
            let url = state.config.destroyGroupRoute;
            let postData = {
                id: item.id
            };

            let { data } = await axios.post(url, postData);
            commit(header.SETTINGS_REMOVE_ITEM_MUTATION, item);
        } catch (error) {
            console.log(error);
        }
    },

    async [header.SETTINGS_FORM_PROPERTY_SEND_ACTION] ({commit, state}) {
        try {
            commit(header.SETTINGS_PROPERTY_FORM_CLEAR_ERRORS_MUTATION);

            let url = state.config.addPropertyRoute;

            let formData = state.propertyFormData;
            formData.group_id = state.currentItem.id;

            let {data} = await window.axios.post(url, formData);
            commit(header.SETTINGS_ADD_PROPERTY_MUTATION, data.property);
            commit(header.SETTINGS_HIDE_PROPERTY_FORM_MUTATION);

        } catch (error) {
            if (error.response.status === 422) {

                let errors = error.response.data.errors;

                commit(header.SETTINGS_PROPERTY_FORM_SET_ERRORS_MUTATION, {
                    slug: errors.slug ? errors.slug[0] : '',
                    title: errors.title ? errors.title[0] : '',
                    description: errors.description ? errors.description[0] : '',
                    type: errors.type ? errors.type[0] : ''
                });

            } else {
                console.log(error);
            }
        }
    },

    async [header.SETTINGS_DESTROY_PROPERTY_ACTION] ({commit, state}, property) {
        try {
            let url = state.config.destroyPropertyRoute;
            let formData = {
                id: property.id
            };

            let {data} = await axios.post(url, formData);
            commit(header.SETTINGS_REMOVE_PROPERTY_MUTATION, property);
        } catch (error) {
            console.log(error);
        }
    },

    async [header.SETTINGS_SAVE_ACTION] ({state, commit, dispatch}) {
        try {
            commit(header.SETTINGS_START_PROCESS);

            let url = state.config.saveAllPropertiesRoute;
            let formData = {};

            _.forEach(state.items, function (state) {
                _.forEach(state.properties, function (property) {
                    formData[property.slug] = property.value;
                });
            });

            let {data} = await axios.post(url, formData);
            dispatch(header.SETTINGS_FETCH_ITEMS_ACTION);
        } catch (error) {
            console.log(error);
        } finally {
            setTimeout(function () {
                commit(header.SETTINGS_STOP_PROCESS);
            }, 300);
        }
    }
};

export default actions;
