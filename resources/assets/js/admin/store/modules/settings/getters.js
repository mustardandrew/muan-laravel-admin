const getters = {
    process(state) {
        return state.process;
    },
    items(state) {
        return state.items;
    },
    currentItem(state) {
        return state.currentItem;
    },
    config(state) {
        return state.config;
    },
    groupFormData(state) {
        return state.groupFormData;
    },
    groupFormErrors(state) {
        return state.groupFormErrors;
    },
    showEditGroupForm(state) {
        return state.showEditGroupForm;
    },
    showAddPropertyForm(state) {
        return state.showAddPropertyForm;
    },
    propertyFormData(state) {
        return state.propertyFormData;
    },
    propertyFormErrors(state) {
        return state.propertyFormErrors;
    },
};

export default getters;
