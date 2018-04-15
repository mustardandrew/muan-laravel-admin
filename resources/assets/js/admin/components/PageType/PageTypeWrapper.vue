<template>
    <div class="page-type-wrapper">

        <div>
            <page-type-add></page-type-add>
            <page-type-list></page-type-list>
        </div>
        <div>

        </div>

    </div>
</template>

<script>
    import PageTypeAdd from './PageTypeAdd';
    import PageTypeList from './PageTypeList';

    export default {
        data() {
            return {
                list: []
            }
        },
        components: {
            PageTypeAdd,
            PageTypeList
        }
    }
</script>
