import './bootstrap';
import './admin/layout';

import Vue from 'vue';
import store from './admin/store';

import PageTypeWrapper from './admin/components/PageType/PageTypeWrapper';
import DataTableWrapper from './admin/components/DataTable/DataTableWrapper';

const admin = new Vue({
    el: '#admin',
    store,
    components: {
        PageTypeWrapper,
        DataTableWrapper,
    }
});
