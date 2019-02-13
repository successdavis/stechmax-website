<template>
    <span>
        <button :class="classes" v-if="active" @click="subscribe">Unsubscribe</button>
        <button class="classes" v-if="! active" @click="subscribe">Subscribe</button>
    </span>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
            classes() {
                return ['small', this.active ? 'blue' : ''];
            }
        },

        methods: {
            subscribe() {
                axios[
                    (this.active ? 'delete' : 'post')
                ](location.pathname + '/subscriptions');

                this.active = ! this.active; 

            }
        }
    }
</script>
