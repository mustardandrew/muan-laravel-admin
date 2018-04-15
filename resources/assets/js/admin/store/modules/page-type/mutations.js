import {
    PAGE_TYPE_ADD_MUTATION,
    PAGE_TYPE_SET_LIST_MUTATION,
    PAGE_TYPE_SET_CURRENT_MUTATION
} from './header';

const mutations = {
    [PAGE_TYPE_ADD_MUTATION] (state, pageType) {
        state.list.push(pageType);
    },
    [PAGE_TYPE_SET_LIST_MUTATION] (state, list) {
        state.list = list;
        if (list.length) {
            this[PAGE_TYPE_SET_CURRENT_MUTATION](state, list[0]);
        }
    },
    [PAGE_TYPE_SET_CURRENT_MUTATION] (state, pageType) {
        state.currentPageType = pageType;
    }
};

export default mutations;
