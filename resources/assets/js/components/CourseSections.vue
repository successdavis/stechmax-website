<template>
    <div class="grid-container">
        <div>
            <form action="" @submit.prevent="addSection" @keydown="Form.errors.clear()">
                <label>Add a new Section
                    <input type="text" aria-describedby="courseRequirementHelpText" v-model="Form.title" required>
                </label>
                <!--<p class="help-text" v-if="Form.errors.has('learn')" v-text="Form.errors.get('body')" id="courseBenefitHelpText"></p>-->
                <button type="submit" class="small button success" :disabled="Form.errors.any()">Add Section</button>

            </form>
            <span v-for="section in sections">
                <p v-text="section.title"></p>

                <courseTopics :section="section"></courseTopics>
            </span>
        </div>
    </div>
</template>

<script>
    import courseTopics from './courseTopics.vue';

    export default {
        components: {courseTopics},

        props: ['data'],

        data () {
            return {
                sections: {},
                Form: new Form({
                    title: ''
                }),
            }
        },

        computed: {
            course_id() {
                return this.data.course.id
            }
        },

        methods: {
            addSection () {
                this.Form.post(`/courses/${this.course_id}/section`)
                    .then(data => {
                            this.sections.push(data);
                            flash('New Section Created')
                        }
                    );
            },
        },

        mounted () {
            axios.get(`/courses/${this.course_id}/section`)
                .then(response => this.sections = response.data)
        }
    }

</script>