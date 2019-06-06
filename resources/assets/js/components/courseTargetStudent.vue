<template>
    <div class="grid-container">
        <p class="mb-3">The descriptions you write here will help students decide if this course/track is the one for them.</p>
        <p>What will students learn in your course?</p>
            <draggable :list="learns" :element="'div'" @change="reOrderLearns">
                <div v-for="(item, index) in learns" :key="item.id">
                    <CourseLearn :learn="item" @deleted="removeLearn(index)"></CourseLearn>
                </div>
            </draggable>
        <form action="" @submit.prevent="addLearn" @keydown="learnForm.errors.clear()">
            <div class="cell">
                <label>
                    <input placeholder="Example: Basic of Photoshop" type="text" aria-describedby="courseBenefitHelpText" v-model="learnForm.body" required>
                </label>
            </div>
            <button type="submit" class="small button success" :disabled="learnForm.errors.any()">Add Learn</button>
        </form>
        
        <p class="mt-3">Are there any course requirements or prerequisites?</p>
        <draggable :list="requirements" :element="'div'" @change="reOrderRequirements">
            <div v-for="(item, index) in requirements" :key="item.id">
                <CourseRequirement :requirement="item" @deleted="removeRequirement(index)"></CourseRequirement>
            </div>
        </draggable>

        <form action="" @submit.prevent="addRequirement" @keydown="requirementForm.errors.clear()">
            <div class="cell">
                <label>Add a requirement
                    <input type="text" aria-describedby="courseRequirementHelpText" v-model="requirementForm.body" required>
                </label>
            </div>
            <button type="submit" class="small button success" :disabled="requirementForm.errors.any()">Add Requirement</button>
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
                axios.get('/courses/' + this.course.id + '/requirement')
                    .then(data => {
                            this.requirements = data.data;
                        }
                    );
            },

            fetchLearns() {
                axios.get('/courses/' + this.course.id + '/learn')
                    .then(data => {
                            this.learns = data.data;
                        }
                    );
            },

            addLearn () {
                this.learnForm.post(`/courses/${this.course.id}/learn`)
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

                axios.put(`/courses/${this.course.id}/learn`, {
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
                this.requirementForm.post(`/courses/${this.course.id}/requirement`)
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

                axios.put(`/courses/${this.course.id}/requirement`, {
                    requirements: this.requirements
                }).then((response) => {
                    console.log(response);
                })
            },

            editLearn(learn) {
                console.log(learn);
            }
        }
    }

</script>
