<template>
    <div>
        <label :for="name"></label>
        <select :name="name" :id="name">
            <option value=""></option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true
            },
            options: {

            }
        },
        data() {

        }
    }
</script>
