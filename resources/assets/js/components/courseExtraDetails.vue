<template>
    <div class="grid-container">
        <form action="" @submit.prevent="addLearn" @keydown="learnForm.errors.clear()">
            <div class="cell">
                <label>Add a new Learning Benefit
                    <input type="text" aria-describedby="courseBenefitHelpText" v-model="learnForm.body" required>
                </label>
                <!--<p class="help-text" v-if="learnForm.errors.has('learn')" v-text="learnForm.errors.get('body')" id="courseBenefitHelpText"></p>-->
                <!--<p class="help-text" v-if="learnForm.errors.has('learn')" v-text="learnForm.errors.get('course_id')" id="courseBenefitHelpText"></p>-->
            </div>
            <button type="submit" class="small button success" :disabled="learnForm.errors.any()">Add Learn</button>
            <div class="grid-container">
                <ul>
                    <li v-for="item in learns" v-text="item.body"></li>
                </ul>
            </div>

        </form>
        <form action="" @submit.prevent="addRequirement" @keydown="requirementForm.errors.clear()">
            <div class="cell">
                <label>Add a requirement
                    <input type="text" aria-describedby="courseRequirementHelpText" v-model="requirementForm.body" required>
                </label>
                <!--<p class="help-text" v-if="requirement.errors.has('learn')" v-text="requirement.errors.get('body')" id="courseBenefitHelpText"></p>-->
                <!--<p class="help-text" v-if="requirement.errors.has('learn')" v-text="requirement.errors.get('course_id')" id="courseBenefitHelpText"></p>-->
            </div>
            <button type="submit" class="small button success" :disabled="requirementForm.errors.any()">Add Requirement</button>
            <div class="grid-container">
                <ul>
                    <li v-for="item in requirements" v-text="item.body"></li>
                </ul>
            </div>

        </form>
    </div>

</template>

<script>
    export default {
        props: ['data'],

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

        methods: {
            addLearn () {
                this.learnForm.post(`/courses/${this.data.course.id}/learn`)
                    .then(data => {
                            this.learns.unshift(data);
                            flash('Data Added Successfully')
                        }
                    );
            },
            addRequirement () {
                this.requirementForm.post(`/courses/${this.data.course.id}/requirement`)
                    .then(data => {
                            this.requirements.unshift(data);
                            flash('Data Added Successfully')
                        }
                    );
            }
        }
    }

</script>