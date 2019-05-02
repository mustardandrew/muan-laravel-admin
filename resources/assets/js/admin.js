import './bootstrap';
import './admin/functions';
import './admin/layout';

import Vue from 'vue';
import store from './admin/store';

import PageTypeWrapper from './admin/components/PageType/PageTypeWrapper';
import DataTableWrapper from './admin/components/DataTable/DataTableWrapper';
import Settings from './admin/components/Settings/Settings';
import UploadImage from './admin/components/UploadImage';
import CodeMirrorWrapper from './admin/components/CodeMirrorWrapper';
import MultiSelect from './admin/components/MultiSelect';

Vue.component('page-type-wrapper', PageTypeWrapper);
Vue.component('data-table-wrapper', DataTableWrapper);
Vue.component('settings', Settings);
Vue.component('upload-image', UploadImage);
Vue.component('code-mirror-wrapper', CodeMirrorWrapper);
Vue.component('multi-select', MultiSelect);

let elements = document.getElementsByClassName("vue-wrapper");

for (let i = 0; i < elements.length; i++) {
    new Vue({
        el: elements[i],
        store
    });
}


