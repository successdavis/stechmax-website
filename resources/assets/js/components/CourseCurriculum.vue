<template>
    <div class="grid-container">
        <div>
        <draggable :list="sections" :element="'div'" @change="reOrderSections">
            <div v-for="(section, index) in sections" :key="section.id">
                <courseSection :section="section, index" @deleted="removeSection(index)"></courseSection>
            </div>
        </draggable>
            <div class="course-section" v-if="addingSection">
                <form @submit.prevent="createSection" @keydown="Form.errors.clear()" @keydown.enter.prevent="createSection">

                    <div class="field">
                      <label class="label">Enter Section Title</label>
                      <div class="control">
                        <input class="input" type="text" v-model="Form.title">
                      </div>
                      <p class="help is-danger" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="description"></p>
                    </div>

                    <div class="field">
                      <label class="label">What will students be able to do at the end of this section?</label>
                      <div class="control">
                        <input class="input" type="text" v-model="Form.description" placeholder="Enter a learning objective">
                      </div>
                      <p class="help is-danger" v-if="Form.errors.has('description')" v-text="Form.errors.get('description')" id="description"></p>
                    </div>

                    <button class="button" @click.prevent="cancel" type="cancel">Cancel</button>
                    <button type="submit" class="button" :disabled="Form.errors.any()">Create</button>
                </form>
                
            </div>
            <button v-if="!addingSection" class="button small success" @click="addingSection = true">Add Section</button>
        </div>
    </div>
</template>

<script>
    import courseTopics from './courseTopics.vue';
    import courseSection from './courseSection.vue';

    export default {
        components: {courseTopics, courseSection},

        props: ['course'],

        data () {
            return {
                addingSection: false,
                sections: [],
                Form: new Form({
                    title: '',
                    description: ''
                }),
            }
        },

        computed: {
            course_id() {
                return this.course.id
            }
        },

        methods: {
            cancel () {
                this.Form.reset();
                this.addingSection = false;
            },

            createSection () {
                this.Form.post(`/manage/${this.course.slug}/section`).then(data => {
                    this.sections.push(data);
                    this.Form.reset();
                    this.addingSection = false;
                    flash('You have added a new Section')
                });
            },

            reOrderSections () {
                this.sections.map((section, index) => {
                    section.order = index + 1;
                })

                axios.put(`/manage/${this.course.slug}/sections`, {
                    sections: this.sections
                }).then((response) => {
                    console.log(response);
                })
            },

            removeSection (index) {
                this.sections.splice(index, 1);
                this.reOrderSections();
            },
        },


        mounted () {
            axios.get(`/manage/${this.course.slug}/sections`)
                .then(response => this.sections = response.data.data)
        }
    }

</script>
