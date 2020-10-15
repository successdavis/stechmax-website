export default {
    data() {
        return {
            items: []
        };
    },
    methods: {
        add(item) {
            console.log('adding client');
            this.items.push(item);

            this.$emit('added');
        },

        remove(index) {
            this.items.splice(index, 1);

            this.$emit('removed');
        }
    }

}
