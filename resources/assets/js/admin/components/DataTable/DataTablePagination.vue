<template>
    <div class="data-table__pagination"
        v-if="data.model">
        Page
        <span @click="prev()" class="pbutton" title="Prev">
            <i class="fa fa-angle-left"></i>
        </span>

        <input type="text"
               v-model="page"
               @keyup.enter="changePage()"
               class=""
               maxlenght="5" />

        <span @click="next()" class="pbutton" title="Next">
            <i class="fa fa-angle-right"></i>
        </span>
        of
        <span class="ptotal">
            {{ data.model.last_page }}
        </span>

        <label>
            <span class="seperator">|</span>
            View
            <select v-model="perPage" @change="changePerPage()">
                <option :value="value" v-for="value in [10, 20, 50, 100, 150]">
                    {{ value }}
                </option>
            </select>
            records
        </label>
    </div>
</template>

<script>
    import {
        DATA_TABLE_SET_PAGE_ACTION,
        DATA_TABLE_SET_PER_PAGE_ACTION
    } from './../../store/modules/data-table/header.js';

    export default {
        data() {
            return {
                page: this.$store.getters['dataTable/currentPage'],
                perPage: this.$store.getters['dataTable/currentPerPage'],
            };
        },
        computed: {
            data()  {
                return this.$store.getters['dataTable/data'];
            },
            query() {
                return this.$store.getters['dataTable/query'];
            },
            currentPage() {
                return this.$store.getters['dataTable/currentPage'];
            },
            currentPerPage() {
                return this.$store.getters['dataTable/currentPerPage'];
            }
        },
        watch: {
            currentPage(value) {
                this.page = value;
            },
            currentPerPage(value) {
                this.perPage = value;
            }
        },
        methods: {
            prev() {
                this.setPage(parseInt(this.query.page) - 1);
            },
            next() {
                this.setPage(parseInt(this.query.page) + 1);
            },
            changePage() {
                this.setPage(parseInt(this.page));
                this.page = this.currentPage;
            },
            changePerPage() {
                this.$store.dispatch(`dataTable/${DATA_TABLE_SET_PER_PAGE_ACTION}`, parseInt(this.perPage));
            },
            setPage(page) {
                this.$store.dispatch(`dataTable/${DATA_TABLE_SET_PAGE_ACTION}`, page);
            }
        }
    }
</script>
