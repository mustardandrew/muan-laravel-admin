<template>
    <span>
        <select class=""
                :name="field"
                v-model="query.filters[field]"
                @change="search()">
            <option value="" selected disabled hidden>{{ column.filter.placeholder }}</option>
            <option v-for="(title, value) in column.filter.options" :value="value">
                {{ title }}
            </option>
        </select>
    </span>
</template>

<script>
    import {
        DATA_TABLE_SEARCH_ACTION
    } from './../../../store/modules/data-table/header';

    export default {
        props: ['column', 'field', 'modelName'],
        computed: {
            query() {
                return this.$store.getters['dataTable/query'];
            },
        },
        methods: {
            search () {
                this.$store.dispatch(`dataTable/${DATA_TABLE_SEARCH_ACTION}`, this.modelName);
            }
        }
    }
</script>
