import './bootstrap';
import './admin/functions';
import './admin/layout';

import Vue from 'vue';
import store from './admin/store';

import PageTypeWrapper from './admin/components/PageType/PageTypeWrapper';
import DataTableWrapper from './admin/components/DataTable/DataTableWrapper';
import UploadImage from './admin/components/UploadImage';

Vue.component('page-type-wrapper', PageTypeWrapper);
Vue.component('data-table-wrapper', DataTableWrapper);
Vue.component('upload-image', UploadImage);

if (document.getElementById('admin')) {
    const admin = new Vue({
        el: '#admin',
        store
    });
}

if (document.getElementById('upload-image')) {
    const uploadImage = new Vue({el: '#upload-image'});
}


