<template>
    <span>
        <input type="text"
               class=""
               :placeholder="column.filter.placeholder"
               :name="field"
               v-model="query.filters[field]"
               @keyup.enter="search()"/>
    </span>
</template>

<script>
    import {
        DATA_TABLE_SEARCH_ACTION
    } from './../../../store/modules/data-table/header';

    export default {
        props: ['column', 'field'],
        computed: {
            query() {
                return this.$store.getters['dataTable/query'];
            },
        },
        methods: {
            search () {
                this.$store.dispatch(`dataTable/${DATA_TABLE_SEARCH_ACTION}`);
            }
        }
    }
</script>
