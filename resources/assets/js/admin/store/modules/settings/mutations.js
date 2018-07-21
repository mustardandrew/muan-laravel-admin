import * as header from './header';

function clearErrorsFromPropertyForm(state) {
    state.propertyFormErrors = {
        slug: '',
        title: '',
        description: '',
        type: ''
    };
}

function clearFromPropertyForm(state) {
    state.propertyFormData = {
        slug: '',
        title: '',
        description: '',
        type: 'string',
        value: ''
    };
    clearErrorsFromPropertyForm(state);
}

const mutations = {
    // Set config
    [header.SETTINGS_SET_CONFIG_MUTATION] (state, config) {
        state.config = config;
    },

    [header.SETTINGS_START_PROCESS] (state) {
        state.process = true;
    },

    [header.SETTINGS_STOP_PROCESS] (state) {
        state.process = false;
    },

    // Set items
    [header.SETTINGS_SET_ITEMS_MUTATION] (state, items) {
        state.items = items;
        state.currentItem = items.length ? items[0] : 'add';
        state.showAddPropertyForm = false;
        state.showEditGroupForm = false;
    },
    // Set current item
    [header.SETTINGS_SET_CURRENT_ITEM_MUTATION] (state, currentItem) {
        state.currentItem = currentItem;
        state.showAddPropertyForm = false;
        state.showEditGroupForm = false;
    },
    // Add new item
    [header.SETTINGS_ADD_ITEM_MUTATION] (state, item) {
        state.items.push(item);
        state.currentItem = item;
        state.showAddPropertyForm = false;
        state.showEditGroupForm = false;
    },

    // Remove item
    [header.SETTINGS_REMOVE_ITEM_MUTATION] (state, item) {
        _.pull(state.items, item);
        state.currentItem = state.items.length ? state.items[0] : 'add';
        state.showAddPropertyForm = false;
        state.showEditGroupForm = false;
    },

    [header.SETTINGS_UPDATE_ITEM_MUTATION] (state, item) {
        let index = _.findIndex(state.items, {
            id: item.id
        });
        state.items[index] = item;
        state.currentItem = state.items[index]
    },

    // Clear Group Form
    [header.SETTINGS_GROUP_FORM_CLEAR_MUTATION] (state) {
        state.groupFormData = {
            slug: '',
            title: '',
            description: ''
        };
        state.groupFormErrors = {
            slug: '',
            title: '',
            description: ''
        };
    },

    [header.SETTINGS_GROUP_FORM_SET_ERRORS_MUTATION] (state, errors) {
        state.groupFormErrors = errors;
    },

    [header.SETTINGS_GROUP_FORM_CLEAR_ERRORS_MUTATION] (state) {
        state.groupFormErrors = {
            slug: '',
            title: '',
            description: ''
        };
    },

    // Show or hide property form

    [header.SETTINGS_SHOW_PROPERTY_FORM_MUTATION] (state) {
        clearFromPropertyForm(state);
        state.showAddPropertyForm = true;
    },

    [header.SETTINGS_HIDE_PROPERTY_FORM_MUTATION] (state) {
        state.showAddPropertyForm = false;
    },

    [header.SETTINGS_TOGGLE_PROPERTY_FORM_MUTATION] (state) {
        if (! state.showAddPropertyForm) {
            clearFromPropertyForm(state);
        }
        state.showAddPropertyForm = ! state.showAddPropertyForm;
    },

    [header.SETTINGS_PROPERTY_FORM_CLEAR_MUTATION] (state) {
        clearFromPropertyForm(state);
    },

    [header.SETTINGS_PROPERTY_FORM_SET_ERRORS_MUTATION] (state, errors) {
        state.propertyFormErrors = errors;
    },

    [header.SETTINGS_PROPERTY_FORM_CLEAR_ERRORS_MUTATION] (state) {
        clearErrorsFromPropertyForm(state);
    },

    [header.SETTINGS_ADD_PROPERTY_MUTATION] (state, property) {
        if (! state.currentItem.properties) {
            state.currentItem.properties = [];
        }
        state.currentItem.properties.push(property);
    },

    [header.SETTINGS_REMOVE_PROPERTY_MUTATION] (state, property) {
        let groupId = property.group_id;

        let index = _.findIndex(state.items, function(item) {
            return item.id == groupId;
        });

        _.pull(state.items[index].properties, property);

        state.items = _.cloneDeep(state.items);
        state.currentItem = state.items[index];
    },


    [header.SETTINGS_SHOW_EDIT_GROUP_FORM_MUTATION] (state) {
        state.showEditGroupForm = true;
    },

    [header.SETTINGS_HIDE_EDIT_GROUP_FORM_MUTATION] (state) {
        state.showEditGroupForm = false;
    }

};

export default mutations;
