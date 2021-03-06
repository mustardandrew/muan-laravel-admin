import Vue from 'vue';
import Vuex from 'vuex';

import mutations from './mutations';
import actions from './actions';
import getters from './getters';

// modules
import pageType from './modules/page-type';
import dataTable from './modules/data-table';
import settings from './modules/settings';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: {}
    },
    getters,
    mutations,
    actions,
    modules: {
        pageType,
        dataTable,
        settings
    }
});

export default store;
