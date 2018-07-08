const getters = {
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
