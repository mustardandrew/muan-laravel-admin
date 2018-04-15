import {
    DATA_TABLE_SET_MUTATION,
    DATA_TABLE_SET_PAGE_MUTATION,
    DATA_TABLE_SET_PER_PAGE_MUTATION,
    DATA_TABLE_SET_COLUMN_MUTATION,
    DATA_TABLE_SET_DIRECTION_MUTATION,
    DATA_TABLE_RESET_MUTATION,

    DATA_TABLE_SET_ID_LIST_MUTATION,
    DATA_TABLE_SET_MESSAGE_MUTATION,

    DATA_TABE_START_LOADING_MUTATION,
    DATA_TABE_STOP_LOADING_MUTATION
} from './header';

const mutations = {
    // Set data from server
    [DATA_TABLE_SET_MUTATION] (state, data) {
        state.data = data;
    },

    // Query

    // Set page
    [DATA_TABLE_SET_PAGE_MUTATION] (state, page) {
        if (page <= 0 || page > state.data.model.last_page) {
            return;
        }
        state.query.page = page;
    },
    // Set per page
    [DATA_TABLE_SET_PER_PAGE_MUTATION] (state, perPage) {
        if (perPage > 0 && perPage <= 100) {
            if (state.query.per_page != perPage) {
                state.query.per_page = perPage;
                state.query.page = 1;
            }
        }
    },
    // Set column
    [DATA_TABLE_SET_COLUMN_MUTATION] (state, column) {
        state.query.column = column;
    },
    // Set direction
    [DATA_TABLE_SET_DIRECTION_MUTATION] (state, direction) {
        state.query.direction = direction;
    },

    // Reset
    [DATA_TABLE_RESET_MUTATION] (state) {
        state.query.filters = {};
    },

    // Loading

    [DATA_TABE_START_LOADING_MUTATION] (state) {
        state.loading = true;
    },
    [DATA_TABE_STOP_LOADING_MUTATION] (state) {
        state.loading = false;
    },

    // Set id list

    [DATA_TABLE_SET_ID_LIST_MUTATION] (state, list) {
        state.idList = list;
    },

    // Message

    [DATA_TABLE_SET_MESSAGE_MUTATION] (state, message) {
        if (message) {
            let flash = document.getElementById('flash-message');
            if (flash) {
                flash.remove();
            }
        }
        state.message = message;
    }
};

export default mutations;
