<template>
    <div class="table-wrapper">

        <div :class="['loading', {'loading--show': loading}]">
            Loading...
        </div>

        <table class="table" v-if="data.model">

            <thead>
                <tr>
                    <!-- For multi operations -->
                    <th v-if="data.actions.tools" style="width: 35px;">
                        <input id="toggle-id"
                               v-model="allCheckbox"
                               @change="changeAllCheckbox()"
                               type="checkbox" />
                        <label for="toggle-id"></label>
                    </th>

                    <!-- columns -->
                    <th v-for="(column, key) in data.columns"
                        :style="column.style"
                        @click="toggleSorted(key, column.sorted)"
                        :class="{
                            'sorted': column.sorted,
                            'sorted--asc': query.column === key && column.sorted && query.direction === 'asc',
                            'sorted--desc': query.column === key && column.sorted && query.direction === 'desc'
                        }">
                        {{ column.title }}
                    </th>

                    <!-- Actions column -->
                    <th style="text-align: center">Actions</th>
                </tr>

                <tr class="filters">

                    <td v-if="data.actions.tools">
                        
                    </td>

                    <td v-for="(column, name) in data.columns">
                        <component
                            v-if="column.filter"
                            :is="column.filter.type"
                            :column="column"
                            :field="name">
                        </component>
                    </td>

                    <!-- Action sections -->
                    <td style="width: 161px">
                        <div class="actions">
                            <button class="button button--dark"
                                    @click="search()">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <button class="button button--red"
                                    @click="reset()">
                                <i class="fas fa-eraser"></i> Reset
                            </button>
                        </div>
                    </td>
                </tr>

            </thead>

            <tbody v-if="data.model.data.length">
                <tr v-for="row in data.model.data">

                    <td v-if="data.actions.tools">
                        <input :id="'id-' + row.id"
                               v-model="idList"
                               :value="row.id"
                               @change="changeCheckbox()"
                               type="checkbox" />
                        <label :for="'id-' + row.id"></label>
                    </td>

                    <td v-for="(column, name) in data.columns" :style="column.style">
                        <component
                            :is="column.field"
                            :value="row[name]">
                        </component>
                    </td>

                    <td style="padding: 3px">
                        <div class="actions" v-if="data.actions && data.actions.entity">
                            <data-table-actions :actions="data.actions.entity"
                                                :data="row">
                            </data-table-actions>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td :colspan="columnsSize + 2 - (data.actions.tools ? 0 : 1)">
                        Data not found!
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

</template>

<script>
    import {
        DATA_TABLE_SET_COLUMN_DIRECTION_ACTION,
        DATA_TABLE_SEARCH_ACTION,
        DATA_TABLE_RESET_ACTION,

        DATA_TABLE_SET_ID_LIST_MUTATION
    } from './../../store/modules/data-table/header';

    // Fields
    import ImageField from './Fields/ImageField.vue';
    import StringField from './Fields/StringField.vue';
    import ActiveField from './Fields/ActiveField.vue';
    import HtmlField from './Fields/HtmlField.vue';

    import LinkField from './Fields/LinkField.vue';
    import SourceField from './Fields/SourceField.vue';
    import AnchorField from './Fields/AnchorField.vue';

    // Filters
    import StringFilter from './Filters/StringFilter.vue';
    import SelectFilter from './Filters/SelectFilter.vue';

    import DataTableActions from './DataTableActions';

    export default {
        data() {
            return {
                idList: [],
                allCheckbox: false
            };
        },
        computed: {
            data() {
                return this.$store.getters['dataTable/data'];
            },
            query() {
                return this.$store.getters['dataTable/query'];
            },
            loading() {
                return this.$store.getters['dataTable/loading'];
            },
            columnsSize() {
                return window._.size(this.data.columns);
            }
        },
        methods: {
            toggleSorted(column, sorted) {
                if (! sorted) {
                    return;
                }

                let data = {};

                if (column === this.query.column) {
                    data.direction = this.query.direction === 'desc' ? 'asc' : 'desc';
                } else {
                    data.column = column;
                    data.direction = 'asc';
                }

                this.$store.dispatch(`dataTable/${DATA_TABLE_SET_COLUMN_DIRECTION_ACTION}`, data);
            },
            search() {
                this.$store.dispatch(`dataTable/${DATA_TABLE_SEARCH_ACTION}`);
            },
            reset() {
                this.$store.dispatch(`dataTable/${DATA_TABLE_RESET_ACTION}`);
            },
            changeCheckbox() {
                this.$store.commit(`dataTable/${DATA_TABLE_SET_ID_LIST_MUTATION}`, this.idList);
            },
            changeAllCheckbox() {
                if (this.allCheckbox) {
                    this.idList = window._.flatMap(this.data.model.data, function (item) {
                        return item.id;
                    });
                } else {
                    this.idList = [];
                }
                this.$store.commit(`dataTable/${DATA_TABLE_SET_ID_LIST_MUTATION}`, this.idList);
            }
        },
        components: {
            // Fields
            ImageField,

            StringField,
            ActiveField,
            HtmlField,

            LinkField,
            SourceField,
            AnchorField,
            // Filters
            StringFilter,
            SelectFilter,
            // Actions
            DataTableActions
        }
    }
</script>
