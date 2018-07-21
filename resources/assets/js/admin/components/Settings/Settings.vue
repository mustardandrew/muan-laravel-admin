<template>

    <div id="settings-tab" class="tabs tabs--vertical" v-if="items">
        <div class="tabs__items">
            <div v-for="item in items" :class="['item', {'active' : item == currentItem}]" @click="setCurrent(item)">
                {{ item.title }}
            </div>
            <div :class="['item', 'item--button', {'active' : currentItem == 'add'}]" @click="clearAddGroupFormData()">
                + Add Group
            </div>
            <div v-if="!(currentItem === 'add' || showEditGroupForm)">
                <button class="button button--gold mt-5 w-100" @click="saveAllProperties()">
                    <span v-if="process">
                        Process
                        <i class="fas fa-sync fa-spin"></i>
                    </span>
                    <span v-else>Save All</span>
                </button>
            </div>
        </div>
        <div class="tabs__contents">
            <div v-for="item in items" class="content" :class="['item', {'active' : item == currentItem}]">
                <group-block :group="item"></group-block>
            </div>

            <div :class="['content', {'active': currentItem === 'add'}]">
                <add-group-form></add-group-form>
            </div>
        </div>
    </div>

</template>

<script>
    import * as header from '../../store/modules/settings/header';

    import AddGroupForm from './AddGroupForm';
    import GroupBlock from './GroupBlock';

    export default {
        props: {
            listRoute: {
                type: String,
                required: true,
            },
            addGroupRoute: {
                type: String,
                required: true,
            },
            editGroupRoute: {
                type: String,
                required: true,
            },
            destroyGroupRoute: {
                type: String,
                required: true
            },
            addPropertyRoute: {
                type: String,
                required: true
            },
            destroyPropertyRoute: {
                type: String,
                required: true
            },
            saveAllPropertiesRoute: {
                type: String,
                required: true
            }
        },

        mounted() {
            this.setConfig();
            this.fetchData();
        },

        computed: {
            items() {
                return this.$store.getters['settings/items'];
            },
            currentItem() {
                return this.$store.getters['settings/currentItem'];
            },
            showEditGroupForm() {
                return this.$store.getters['settings/showEditGroupForm'];
            },
            process() {
                return this.$store.getters['settings/process'];
            }
        },

        components: {
            AddGroupForm,
            GroupBlock
        },

        methods: {
            setConfig() {
                this.$store.commit(`settings/${header.SETTINGS_SET_CONFIG_MUTATION}`, {
                    listRoute: this.listRoute,
                    addGroupRoute: this.addGroupRoute,
                    editGroupRoute: this.editGroupRoute,
                    destroyGroupRoute: this.destroyGroupRoute,
                    addPropertyRoute: this.addPropertyRoute,
                    destroyPropertyRoute: this.destroyPropertyRoute,
                    saveAllPropertiesRoute: this.saveAllPropertiesRoute
                });
            },
            fetchData() {
                this.$store.dispatch(`settings/${header.SETTINGS_FETCH_ITEMS_ACTION}`);
            },
            setCurrent(item) {
                this.$store.commit(`settings/${header.SETTINGS_SET_CURRENT_ITEM_MUTATION}`, item);
            },
            clearAddGroupFormData() {
                this.$store.commit(`settings/${header.SETTINGS_SET_CURRENT_ITEM_MUTATION}`, 'add');
                this.$store.commit(`settings/${header.SETTINGS_GROUP_FORM_CLEAR_MUTATION}`);
            },
            saveAllProperties() {
                this.$store.dispatch(`settings/${header.SETTINGS_SAVE_ACTION}`);
            }
        }

    }
</script>

