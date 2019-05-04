<template>
    <div>

        <multiselect v-model="selectedItems"
                     id="ajax"
                     label="name"
                     track-by="code"
                     placeholder="Type to search"
                     open-direction="bottom"
                     :options="items"
                     :multiple="true"
                     :searchable="true"
                     :loading="isLoading"
                     :internal-search="false"
                     :clear-on-select="true"
                     :close-on-select="false"
                     :options-limit="300"
                     :limit="10"
                     :limit-text="limitText"
                     :max-height="600"
                     :show-no-results="false"
                     :hide-selected="true"
                     @search-change="asyncFind">

            <template slot="tag" slot-scope="{ option, remove }">
                <span class="multiselect__tag">
                    <span>{{ option.title }}</span>
                    <i aria-hidden="true" tabindex="1" class="multiselect__tag-icon" @click="remove(option)"></i>
                </span>
            </template>

            <template slot="option" slot-scope="props">
                <div class="option__desc"><span class="option__title">{{ props.option.title }}</span></div>
            </template>

            <template slot="clear" slot-scope="props">
                <div class="multiselect__clear"
                     v-if="selectedItems && selectedItems.length"
                     @mousedown.prevent.stop="clearAll(props.search)">
                </div>
            </template>

        </multiselect>

        <select style="display: none;" multiple :name="name" :id="name">
            <option v-for="item in selectedItems" :value="item.code" selected>
                {{ item.title }}
            </option>
        </select>

    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    import 'vue-multiselect/dist/vue-multiselect.min.css';

    export default {
        props: {
            source: {
                type: String,
                require: true
            },
            name: {
                type: String,
                require: true
            },
            values: {
                type: Array,
                default: () => [],
            }
        },
        components: {
            Multiselect
        },
        data () {
            return {
                selectedItems: this.values,
                items: [],
                isLoading: false
            }
        },
        methods: {
            limitText (count) {
                return `and ${count} other countries`
            },
            async asyncFind (query) {
                if (! query) { return; }

                this.isLoading = true;
                let {data} = await window.axios.get(`${this.source}?q=${query}`);
                this.items = data.data;
                this.isLoading = false;
            },
            clearAll () {
                this.selectedItems = [];
            }
        }
    }
</script>

<style>
    .multiselect__tags, .multiselect__content-wrapper {
        border: 1px solid #999;
    }
    .multiselect__content-wrapper {
        border-top: 0;
    }
    .multiselect__tag,
    .multiselect__option--highlight,
    .multiselect__option--highlight:after
    {
        background: #303a47;
    }
    .multiselect__spinner:before {
        border-color: #303a47;
    }
    .multiselect__spinner:after {
        border-color: #b4bcc8;
    }
    .multiselect__tag-icon:after {
        color: #fff;
    }
    .multiselect__tag-icon:hover {
        background-color: #b4bcc8;
        color: #303a47;
    }
</style>
