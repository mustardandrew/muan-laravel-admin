import * as header from './header';

const actions = {
    // Load data from database
    async [header.DATA_TABLE_GET_LIST_ACTION] ({commit, state}, modelName) {
        try {
            commit(header.DATA_TABE_START_LOADING_MUTATION);

            let url = `/${window.adminSlug}/api/${modelName}?`;

            if (state.query.column) {
                url += `column=${state.query.column}`
                    + `&direction=${state.query.direction}&`;
            }

            url += `page=${state.query.page}`
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
                url += '&' + strArray.join("&");
            }

            let { data } = await window.axios.get(url);
            commit(header.DATA_TABLE_SET_MUTATION, data);
        } catch (error) {
            console.log(error);
        } finally {
            commit(header.DATA_TABE_STOP_LOADING_MUTATION);
        }
    },

    // Query

    // Set page
    [header.DATA_TABLE_SET_PAGE_ACTION] ({commit, dispatch, state}, data) {
        let oldPage = state.query.page;
        commit(header.DATA_TABLE_SET_PAGE_MUTATION, data.page);
        if (oldPage !== state.query.page) {
            commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
            dispatch(header.DATA_TABLE_GET_LIST_ACTION, data.modelName);
        }
    },

    // Set per page
    [header.DATA_TABLE_SET_PER_PAGE_ACTION] ({commit, dispatch, state}, data) {
        let oldPerPage = state.query.per_page;
        commit(header.DATA_TABLE_SET_PER_PAGE_MUTATION, data.perPage);
        if (oldPerPage !== state.query.per_page) {
            commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
            dispatch(header.DATA_TABLE_GET_LIST_ACTION, data.modelName);
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
        dispatch(header.DATA_TABLE_GET_LIST_ACTION, data.modelName);
    },

    // Reset
    [header.DATA_TABLE_RESET_ACTION] ({commit, dispatch}, modelName) {
        commit(header.DATA_TABLE_RESET_MUTATION);
        commit(header.DATA_TABLE_SET_PAGE_MUTATION, 1);
        commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
        dispatch(header.DATA_TABLE_GET_LIST_ACTION, modelName);
    },

    // Search
    [header.DATA_TABLE_SEARCH_ACTION] ({commit, dispatch}, modelName) {
        commit(header.DATA_TABLE_SET_PAGE_MUTATION, 1);
        commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);
        dispatch(header.DATA_TABLE_GET_LIST_ACTION, modelName);
    },

    // Multi action
    async [header.DATA_TABLE_MULTI_ACTION] ({commit, dispatch, state}, params) {
        try {
            commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, []);

            let { data } = await window.axios.post(`${params.route}`, {
                'ids': state.idList
            });

            if (data.message) {
                commit(header.DATA_TABLE_SET_MESSAGE_MUTATION, data);
            }

            dispatch(header.DATA_TABLE_GET_LIST_ACTION, params.modelName);
        } catch (error) {
            console.log(error);
        } finally {
            commit(header.DATA_TABLE_SET_ID_LIST_MUTATION, []);
        }
    }
};

export default actions;
