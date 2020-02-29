<template>
    <span :class="classes" @click="toggle" class="icon is-small">
        <i class="fas fa-heart"></i>
        <span v-text="favoritesCount"></span>
    </span>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return [this.isFavorited ? 'success' : 'secondary'];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                return this.isFavorited ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint);
                this.isFavorited = true;
                this.favoritesCount++;
            }, 

            destroy() {
                axios.delete(this.endpoint);
                this.isFavorited = false;
                this.favoritesCount--;
            }
        }
    }

</script>
