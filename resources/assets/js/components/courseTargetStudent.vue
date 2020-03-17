<template>
    <div>
        <p class="mb-3">The information you write here will help students decide if this course/track is the one for them.</p>
        <p>What will students learn in your course?</p>
            <draggable :list="learns" handle=".handle" :element="'div'" @change="reOrderLearns">
                <transition-group type="transition" name="flip-list">
                    <div v-for="(item, index) in learns" :key="item.id">
                        <CourseLearn :learn="item" @deleted="removeLearn(index)"></CourseLearn>
                    </div>
                </transition-group>
            </draggable>
        <form action="" @submit.prevent="addLearn" @keydown="learnForm.errors.clear()">
            <div class="field">
              <label class="label"></label>
              <div class="control">
                <input class="input is-static input_bt" type="text" placeholder="Example: Basic of Photoshop" v-model="learnForm.body" required>
              </div>
            </div>

            <div class="control">
                <button type="submit" class="button is-link" :disabled="learnForm.errors.any()">Add Learn</button>
            </div>
            <!--  -->
        </form>
        
        <p class="mt-3">Are there any course requirements or prerequisites?</p>
        <draggable :list="requirements" handle=".handle" :element="'div'" @change="reOrderRequirements">
            <transition-group type="transition" name="flip-list">
                <div v-for="(item, index) in requirements" :key="item.id">
                    <CourseRequirement :requirement="item" @deleted="removeRequirement(index)"></CourseRequirement>
                </div>
            </transition-group>
        </draggable>

        <form action="" @submit.prevent="addRequirement" @keydown="requirementForm.errors.clear()">
            <div class="field">
              <label class="label">Add a requirement</label>
              <div class="control">
                <input class="input is-static input_bt" type="text" v-model="requirementForm.body" required>
              </div>
            </div>
            <!--  -->
            <div class="control">
                <button type="submit" class="button is-link" :disabled="requirementForm.errors.any()">Add Requirement</button>
            </div>
        </form>
    </div>

</template>

<script>
    import draggable from 'vuedraggable'
    import CourseLearn from './CourseLearn.vue';
    import CourseRequirement from './CourseRequirement.vue';
    export default {
        components: {
            draggable, CourseLearn, CourseRequirement
        },
        props: ['course'],

        data () {
            return {
                learns: [],
                requirements: [],

                learnForm: new Form({
                    body: ''
                }),

                requirementForm: new Form({
                    body: ''
                }),
            }
        },

        created() {
            this.fetchRequirements();
            this.fetchLearns();
        },

        methods: {
            fetchRequirements() {
                axios.get('/courses/' + this.course.slug + '/requirement')
                    .then(data => {
                            this.requirements = data.data;
                        }
                    );
            },

            fetchLearns() {
                axios.get('/courses/' + this.course.slug + '/learn')
                    .then(data => {
                            this.learns = data.data;
                        }
                    );
            },

            addLearn () {
                this.learnForm.post(`/courses/${this.course.slug}/learn`)
                    .then(data => {
                            this.learns.push(data);
                            this.learnForm.reset();
                        }
                    );
            },
            reOrderLearns () {
                this.learns.map((learn, index) => {
                    learn.order = index + 1;
                })

                axios.put(`/courses/${this.course.slug}/learn`, {
                    learns: this.learns
                }).then((response) => {
                    console.log(response);
                })
            },

            removeLearn(index) {
                this.learns.splice(index, 1);
            },

            removeRequirement (index) {
                this.requirements.splice(index, 1);
            },

            addRequirement () {
                this.requirementForm.post(`/courses/${this.course.slug}/requirement`)
                    .then(data => {
                            this.requirements.push(data);
                            this.requirementForm.reset();
                        }
                    );
            },

            reOrderRequirements () {
                this.requirements.map((requirement, index) => {
                    requirement.order = index + 1;
                })

                axios.put(`/courses/${this.course.slug}/requirement`, {
                    requirements: this.requirements
                }).then((response) => {
                    console.log(response);
                })
            },

            editLearn(learn) {
                console.log(learn);
            }
        }
    };

</script>

<style scoped>
    .input_bt {
        border-bottom: 1px solid black;
        padding: 1.5em 0;
    }
</style>