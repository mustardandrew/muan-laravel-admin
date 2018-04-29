import './bootstrap';
import './admin/functions';
import './admin/layout';

import Vue from 'vue';
import store from './admin/store';

import PageTypeWrapper from './admin/components/PageType/PageTypeWrapper';
import DataTableWrapper from './admin/components/DataTable/DataTableWrapper';
import UploadImage from './admin/components/UploadImage';

const admin = new Vue({
    el: '#admin',
    store,
    components: {
        PageTypeWrapper,
        DataTableWrapper,
        UploadImage
    }
});
