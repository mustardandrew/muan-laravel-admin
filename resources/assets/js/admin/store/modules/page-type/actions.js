import {
    PAGE_TYPE_ADD_ACTION,
    PAGE_TYPE_GET_LIST_ACTION,
    PAGE_TYPE_ADD_MUTATION,
    PAGE_TYPE_SET_LIST_MUTATION
} from './header';

const actions = {
    async [PAGE_TYPE_ADD_ACTION] (context, pageType) {
        try {
            let { data } = await window.axios.post('/api/page_type', pageType);
            context.commit(PAGE_TYPE_ADD_MUTATION, data.pageType);
        } catch (error) {
            console.log(error);
        }
    },
    async [PAGE_TYPE_GET_LIST_ACTION] (context) {
        try {
            let {data} = await window.axios.get('/api/page_type');
            context.commit(PAGE_TYPE_SET_LIST_MUTATION, data.list);
        } catch (error) {
            console.log(error);
        }
    }
};

export default actions;
