const getters = {
    data(state) {
        return state.data;
    },
    query(state) {
        return state.query;
    },
    loading(state) {
        return state.loading;
    },
    currentPage(state) {
        return state.query.page;
    },
    currentPerPage(state) {
        return state.query.per_page;
    },
    idList(state) {
        return state.idList;
    },
    message(state) {
        return state.message;
    }
};

export default getters;
