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

let elements = document.getElementsByClassName("vue-wrapper");

for (let i = 0; i < elements.length; i++) {
    new Vue({
        el: elements[i],
        store
    });
}


