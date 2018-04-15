<template>
    <div class="data-table">

        <div v-if="message && message.level" :class="[
            'message',
            'message--' + message.level,
            'mb-10'
        ]">
            <strong>{{ message.level }}:</strong>
            {{ message.message }}
        </div>

        <div class="data-table__title">

            <h1>{{ modelName }}</h1>

            <div class="flex-space"></div>

            <a class="button button--dark"
               v-if="data.actions && data.actions.create"
               :href="data.actions.create.route"
               :title="data.actions.create.title">
                <i :class="data.actions.create.icon ? data.actions.create.icon : 'far fa-file'"></i>
                &nbsp;{{ data.actions.create.title }}
            </a>

            <div v-if="data.actions && data.actions.tools" class="dropdown ml-5">
                <div class="dropdown--title">
                    Tools <i class="fas fa-angle-down"></i>

                    <div class="dropdown--list-wrapper">
                        <div class="dropdown--list">
                            <div v-for="action in data.actions.tools"
                                 @click="gotoAction(action.route)"
                                 class="dropdown--item">
                                <i :class="action.icon"></i> {{ action.title }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <data-table-pagination :model-name="modelName"></data-table-pagination>
        <data-table-table :model-name="modelName"></data-table-table>
        <data-table-pagination :model-name="modelName"></data-table-pagination>
    </div>
</template>

<script>
    import {
        DATA_TABLE_GET_LIST_ACTION,
        DATA_TABLE_MULTI_ACTION
    } from '../../store/modules/data-table/header';

    import DataTablePagination from './DataTablePagination';
    import DataTableTable from './DataTableTable';

    export default {
        props: ['modelName'],
        mounted() {
            this.fetchData();
        },
        computed: {
            message() {
                return this.$store.getters['dataTable/message'];
            },
            data() {
                return this.$store.getters['dataTable/data'];
            },
            query() {
                return this.$store.getters['dataTable/query'];
            },
            idList() {
                return this.$store.getters['dataTable/idList'];
            }
        },
        methods: {
            fetchData() {
                this.$store.dispatch(`dataTable/${DATA_TABLE_GET_LIST_ACTION}`, this.modelName);
            },
            gotoAction(route) {
                if (this.idList.length) {
                    this.$store.dispatch(`dataTable/${DATA_TABLE_MULTI_ACTION}`, {
                        modelName: this.modelName,
                        route: route
                    });
                }
            }
        },
        components: {
            DataTablePagination,
            DataTableTable
        }
    };
</script>
