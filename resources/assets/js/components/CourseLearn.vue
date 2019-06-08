<template>
    <div class="grid-x">
        <div class="floating-button-body medium-11">
            <input type="text" v-model="body" class="cell" @change="update()">
            <span class="medium-2 floating-button buttons-right">
                <i class="far fa-trash-alt c_buttons" @click="deleteItem()"></i>
                <i class="fas fa-arrows-alt c_buttons--move handle" title="Drag this button to re-order items"></i>
            </span>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: ['learn'],

        data () {
            return {
                id: this.learn.id,
                body: this.learn.body
            }
        },

        methods: {
            deleteItem () {
                axios.delete(`/courses/${this.id}/learn`);

                this.$emit('deleted', this.learn.id);
            },

            update() {
                axios.patch(`/courses/${this.id}/learn`, {body: this.body});
            }
        }
    }
</script>
