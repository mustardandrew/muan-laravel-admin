import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const pageType = {
    state: {
        list: [],
        currentPageType: {}
    },
    getters,
    mutations,
    actions,
};

export default pageType;
