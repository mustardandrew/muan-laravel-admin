import mutations from './mutations';
import actions from './actions';
import getters from './getters';

const dataTable = {
    namespaced: true,
    state: {
        config: {
            route: '',
            title: 'Unnamed'
        },
        data: {},
        loading: false,
        query: {
            page: 1,
            column: '',
            direction: 'desc',
            per_page: 10,
            filters: {},
        },
        idList: [],
        message: []
    },
    getters,
    mutations,
    actions
};

export default dataTable;
