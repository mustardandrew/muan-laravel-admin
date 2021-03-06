import * as header from './header';

const actions = {
    // Load data from database
    async [header.DATA_TABLE_GET_LIST_ACTION] ({commit, state}) {
        try {
            commit(header.DATA_TABE_START_LOADING_MUTATION);

            let url = `${state.config.route}`;
            let params = '';


            if (state.query.column) {
                params += `column=${state.query.column}`
                    + `&direction=${state.query.direction}&`;
            }

            params += `page=${state.query.page}`
                + `&per_page=${state.query.per_page}`;

            let strArray = [];
            for (let property in state.query.filters) {
                if (state.query.filters.hasOwnProperty(property)) {

                    let value = state.query.filters[property];
                    if (value === '') { continue; }

                    let pair = encodeURIComponent(`filters[${property}]`) + "=" + encodeURIComponent(value);
                    strArray.push(pair);
                }
            }
            if (strArray.length) {
                params += '&' + strArray.join("&");
            }

            let { data } = await window.axios.get(url + '?' + params);
            commit(header.DATA_TABLE_SET_MUTATION, data);
            history.pushState(null, this.title, '?' + params);
        } catch (error) {
            console.log(error);
        } finally {
            commit(header.DATA_TABE_STOP_LOADING_MUTATION);
        }
    },

    // Query

    // Set page
    [header.DATA_TABLE_SET_PAGE_ACTION] ({commit, dispatch, state}, page) {
        let oldPage = state.query.page;
        commit(header.DATA_TABLE_SET_PAGE_MUTATION, page);
        if (oldPage !== state.query.page) {
            commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
            dispatch(header.DATA_TABLE_GET_LIST_ACTION);
        }
    },

    // Set per page
    [header.DATA_TABLE_SET_PER_PAGE_ACTION] ({commit, dispatch, state}, perPage) {
        let oldPerPage = state.query.per_page;
        commit(header.DATA_TABLE_SET_PER_PAGE_MUTATION, perPage);
        if (oldPerPage !== state.query.per_page) {
            commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
            dispatch(header.DATA_TABLE_GET_LIST_ACTION);
        }
    },

    // Sorted
    [header.DATA_TABLE_SET_COLUMN_DIRECTION_ACTION] ({commit, dispatch}, data) {
        if (data.column) {
            commit(header.DATA_TABLE_SET_COLUMN_MUTATION, data.column);
        }
        if (data.direction) {
            commit(header.DATA_TABLE_SET_DIRECTION_MUTATION, data.direction);
        }
        commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
        dispatch(header.DATA_TABLE_GET_LIST_ACTION);
    },

    // Reset
    [header.DATA_TABLE_RESET_ACTION] ({commit, dispatch}) {
        commit(header.DATA_TABLE_RESET_MUTATION);
        commit(header.DATA_TABLE_SET_PAGE_MUTATION, 1);
        commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
        dispatch(header.DATA_TABLE_GET_LIST_ACTION);
    },

    // Search
    [header.DATA_TABLE_SEARCH_ACTION] ({commit, dispatch}) {
        commit(header.DATA_TABLE_SET_PAGE_MUTATION, 1);
        commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
        dispatch(header.DATA_TABLE_GET_LIST_ACTION);
    },

    // Multi action
    async [header.DATA_TABLE_MULTI_ACTION] ({commit, dispatch, state}, route) {
        try {
            commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);

            let { data } = await window.axios.post(`${route}`, {
                'ids': state.idList
            });

            if (data.message) {
                commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, data);
            }

            dispatch(header.DATA_TABLE_GET_LIST_ACTION);
        } catch (error) {
            console.log(error);
        } finally {
            commit(header.DATA_TABLE_SET_ID_LIST_MUTATION, []);
        }
    }
};

export default actions;
