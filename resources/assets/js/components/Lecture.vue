<template>
    <div class="course-lecture ">
        <div v-if="editing">
            <form @submit.prevent="update" @keydown="Form.errors.clear()">
                <label for="title">Edit Lecture</label>
                <input id="title" type="text" v-model="Form.title">
                <p class="help-text" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="title"></p>
                <button @click.prevent="cancel">Cancel</button>
                <button class="button small">Update</button>
            </form>
        </div>
        <div class="display-mini-icons" v-else>
            <span><i class="fas fa-book"></i><strong> Lecture {{lecture.order}} : </strong></span>
            <p class="inline" v-text="Form.title"></p>
            <span>
                <i class="far fa-edit mini-icons" @click="editing = true"></i>
                <i class="fas fa-trash mini-icons" @click="remove"></i>
            </span>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['lecture'],

        data () {
            return {
                editing: false,
                id: this.lecture.id,
                Form: new Form ({
                    title: this.lecture.title
                }),
            }
        },

        methods: {
            remove () {
                axios.delete(`/manage/${this.id}/lecture`);

                this.$emit('deleted', this.id);
            },

            update() {
                axios.patch(`/manage/${this.id}/lecture`, {title: this.Form.title});
                this.editing = false;
            },

            cancel () {
                this.Form.reset();
                this.editing = false;
            }
        }
    }
</script>
