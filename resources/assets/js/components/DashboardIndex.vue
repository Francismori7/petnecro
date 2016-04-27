<template>
</template>

<script type="text/babel">
    export default {
        data() {
            return {};
        },

        ready() {
        },

        props: [
            'user'
        ],

        methods: {
            canAddPets() {
                return this.user.pets.length < this.user.maximum_pets;
            }
        }
    };
</script>