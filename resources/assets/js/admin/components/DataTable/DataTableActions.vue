<template>
    <div>
        <a v-for="action in actions"
           class="button"
           :style="action.style"
           :href="createRoute(action.route)"
           :title="action.title">
            <i v-if="action.icon" :class="action.icon"></i>
            <span v-else>{{ action.title }}</span>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['actions', 'data'],
        methods: {
            createRoute(route) {
                route = decodeURI(route);
                if (this.data) {
                    for (let key in this.data) {
                        let value = this.data[key];
                        route = _.replace(route, `[${key}]`, value);
                    }
                }
                return route;
            }
        }
    }
</script>
