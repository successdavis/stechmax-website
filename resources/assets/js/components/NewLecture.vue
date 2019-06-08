
<template>
    <div>
        <form @submit.prevent="create" @keydown="Form.errors.clear()" @keydown.enter.prevent="create">
            <label for="title">New Lecture</label>
            <input id="title" type="text" v-model="Form.title">
            <p class="help-text" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="title"></p>
            <button @click.prevent="cancel">Cancel</button>
            <button class="button small">Add</button>
        </form>
    </div>
</template>
<script>
    export default {
        props: ['section'],
        data () {
            return {
                Form: new Form ({
                    title: ''
                }),
            }
        },

        methods: {
            cancel() {
                this.title = '';
                this.$emit('cancel');
            },

            create () {
                this.Form.post(`/manage/${this.section.id}/lecture`)
                    .then(data => {
                            this.$emit('created', data);
                            flash('New Lecture Created')
                        }
                    );
            },
        }
    }
</script>
