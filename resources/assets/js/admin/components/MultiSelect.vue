<template>
    <div>

        <div class="multi-select">
            <div class="item" v-for="item in selectedItems">
					<span class="item__title">{{item.title}}</span>
					<span class="item__close" v-on:click.prevent="closeItem(item)">
						<i class="fas fa-times"></i>
					</span>
            </div>
            <input type="text"
                   v-on:keyup.prevent="keyUp"
                   v-on:key="keyDown"
                   v-on:keydown.enter.prevent="selectItem"
                   v-on:keyup.delete.prevent="deleteLastItem"
                   v-model="inputSelect" />
        </div>

        <div class="multi-autocomplete-wrapper" v-if="showAutocomplate">
            <div class="multi-autocomplete">
                <div v-for="item in findedItems"
                     :class="{'item': true,'item-selected': currentSelected === item}"
                     @mouseover="overItem(item)"
                     @click="clickItem(item)">
                    {{item.title}}
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            canCreatedNew : {
                type: Boolean,
                default: false,
            },
            route: {
                type: String
            },
            getOnce: {
                type: Boolean,
                default: true,
            }
        },
        data() {
            return {
                inputSelect: "",
                selectedItems: [],
                existsItems: [
                    { title: "hello" },
                    { title: "help" },
                    { title: "world" },
                    { title: "hehehe" }
                ],
                findedItems: [],
                currentSelected: null,
                backspaceCount: 0
            };
        },
        computed: {
            showAutocomplate() {
                return this.findedItems.length;
            }
        },
        methods: {
            selectItem() {

                if (this.currentSelected) {
                    this.selectedItems.push(this.currentSelected);
                    this.findedItems = [];
                    this.currentSelected = null;
                    this.inputSelect = "";
                    this.backspaceCount = 1;
                    return;
                }

                if (this.canCreatedNew) {
                    let item = {
                        title: this.inputSelect
                    };
                    this.selectedItems.push(item);
                    this.inputSelect = "";
                    this.backspaceCount = 1;
                }
            },
            keyUp() {
                if (! this.inputSelect) {
                    this.findedItems = [];
                    return;
                }

                let regExp = new RegExp(this.inputSelect, "i");
                this.findedItems = this.existsItems.filter((item) => {
                    return item.title.search(regExp) >= 0
                        && this.selectedItems.indexOf(item) === -1;
                });

                if (this.findedItems.length > 0) {
                    let index = this.findedItems.indexOf(this.currentSelected);
                    if (index === -1) {
                        this.currentSelected = this.findedItems[0];
                    }
                } else {
                    this.currentSelected = null;
                }


                this.backspaceCount = 0;
            },
            keyDown(event) {
                if (event.code === "Enter") { this.selectItem(); }
                if (event.code === "ArrowDown") { this.arrowDown(); }
                if (event.code === "ArrowUp" ) { this.arrowUp(); }
            },
            arrowUp() {
                if (this.findedItems.length === 0) {
                    return;
                }

                let index = this.findedItems.indexOf(this.currentSelected);
                if (index > 0) {
                    this.currentSelected = this.findedItems[index - 1];
                }
            },
            arrowDown() {
                if (this.findedItems.length === 0) {
                    return;
                }

                let index = this.findedItems.indexOf(this.currentSelected);
                console.log(index);
                console.log(this.findedItems.length);
                if (index + 1 < this.findedItems.length) {
                    console.log(this.currentSelected);
                    this.currentSelected = this.findedItems[index + 1];
                    console.log(this.currentSelected);
                }
            },
            deleteLastItem() {
                if (this.inputSelect === "") {
                    ++ this.backspaceCount;
                }

                if (this.backspaceCount >= 2) {
                    if (this.selectedItems.length) {
                        this.selectedItems.pop();
                    }
                    this.backspaceCount = 1;
                }
            },
            closeItem(item) {
                let index = this.selectedItems.indexOf(item);
                this.selectedItems.splice(index, 1);
            },
            overItem(item) {
                this.currentSelected = item;
            },
            clickItem(item) {
                this.overItem(item);
                this.selectItem();
            }
        },
    }
</script>

<style>
    .multi-select {
        display: flex;
        flex-wrap: wrap;
        border: 1px solid #b4bcc8;
        padding: 10px 5px 5px 10px;
        border-radius: 8px;
        font-size: 1rem;
    }

    .multi-select .item {
        background-color: #2b3643;
        color: #b4bcc8;
        padding: 8px 10px;
        margin: 0 5px 5px 0;
        border-radius: 8px;
    }
    .multi-select .item__close {
        cursor: pointer;
        display: inline-block;
        margin-left: 5px
    }
    .multi-select .item__close:hover {
        color: #fff;
    }

    .multi-select input {
        width: 100%;
        flex: 1;
        min-width: 10px;
        max-width: 100%;
        margin: 0 5px 5px 0;
        padding: 8px 0;
        border: 0;
        font-size: 1rem;
    }
    .multi-select input:focus {
        outline: none;
    }

    .multi-autocomplete-wrapper {
        position: relative;
    }

    .multi-autocomplete {
        position: absolute;
        background-color: #fff;
        border: 1px solid #b4bcc8;
        border-radius: 8px;
        left: 0;
        right: 0;
        padding: 10px;
        top: 0;
        margin-top: 2px;
        z-index: 10;
    }

    .multi-autocomplete .item {
        padding: 10px;
        border-radius: 4px;
    }
    .item-selected {
        background-color: #2b3643;
        color: #fff;
    }
</style>
