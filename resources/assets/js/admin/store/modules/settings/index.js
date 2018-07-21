import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const settings = {
    namespaced: true,
    state: {
        config: {
            listRoute: null,
            addGroupRoute: null,
            editGroupRoute: null,
            destroyGroupRoute: null,
            addPropertyRoute: null,
            destroyPropertyRoute: null,
            saveAllPropertiesRoute: null
        },

        process: false,

        items: [],
        currentItem: null,

        groupFormData: {
            slug: '',
            title: '',
            description: ''
        },
        groupFormErrors: {
            slug: '',
            title: '',
            description: ''
        },

        showEditGroupForm: false,
        showAddPropertyForm: false,

        propertyFormData: {
            slug: '',
            title: '',
            description: '',
            type: 'string',
            value: ''
        },
        propertyFormErrors: {
            slug: '',
            title: '',
            description: '',
            type: '',
        }
    },
    getters,
    mutations,
    actions
};

export default settings;
