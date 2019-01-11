<template>
    <button :class="classes" type="submit" @click="toggle">
        <i class="fi-heart"></i>
        <span v-text="favoritesCount"></span>
    </button>
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
                return ['small button', this.isFavorited ? 'success' : 'secondary'];
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
