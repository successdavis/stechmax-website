<template>
    <div class="grid-x">
        <input type="text" v-model="body" class="medium-10" @change="update()">
        <span class="medium-2">
            <i class="far fa-trash-alt c_buttons" @click="deleteItem()">D</i>
            <i class="fas fa-arrows-alt c_buttons--move" title="Drag this button to re-order items"></i>
        </span>
    </div>
    
</template>

<script>
    export default {
        props: ['requirement'],

        data () {
            return {
                id: this.requirement.id,
                body: this.requirement.body
            }
        },

        methods: {
            deleteItem () {
                axios.delete(`/courses/${this.id}/requirement`);

                this.$emit('deleted', this.requirement.id);
            },

            update() {
                axios.patch(`/courses/${this.id}/requirement`, {body: this.body});
            }
        }
    }
</script>
