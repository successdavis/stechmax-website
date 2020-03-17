<template>
    <div class="grid-x ">
        <div class="medium-11 floating-button-body">
            <div class="field">
              <div class="control">
                <input class="input is-primary" type="text" v-model="body" @change="update()">
              </div>
            </div>
            <span class="medium-2 floating-button buttons-right">
                <i class="far fa-trash-alt c_buttons" @click="deleteItem()"></i>
                <i class="fas fa-arrows-alt c_buttons--move handle" title="Drag this button to re-order items"></i>
            </span>
        </div>
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
