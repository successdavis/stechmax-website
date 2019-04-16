<template>
    <div>

        <form v-if="step === 1" class="course_registration" @submit.prevent="addCourse" @keydown="Form.errors.clear()">
            <div class="grid-container">
                <h5 class="center-text mt-2">Step One <i class="fas fa-angle-double-right"></i>  Basic Course Details </h5>

             <div class="grid-x grid-padding-x">
               <div class="cell">
                  <label>Select Subject
                    <select aria-describedby="subjectHelpText" v-model="Form.subject_id" required>
                    <option disabled selected>Select Subject Type</option>
                      <option :value="subject.id" aria-describedby="subjectHelpText" v-for="subject in Data.subjects" v-text="subject.name"></option>
                    </select>
                  </label>
                  <p class="help-text" v-if="Form.errors.has('subject_id')" v-text="Form.errors.get('subject_id')" id="subjectHelpText"></p>
               </div>

               <div class="cell">
                 <label>Course Title
                   <input type="text" aria-describedby="courseTitleHelpText" v-model="Form.title" required>
                 </label>
               <p class="help-text" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="courseTitleHelpText"></p>
               </div>

               <div class="medium-6 cell">
                  <label>Course Type
                    <select aria-describedby="typeHelpText" v-model="Form.type_id" required>
                      <option disabled selected>Select Course Type</option>
                      <option :value="type.id" v-for="type in Data.types" v-text="type.name"></option>
                    </select>
                  </label>
                  <p class="help-text" id="typeHelpText" v-if="Form.errors.has('type_id')" v-text="Form.errors.get('type_id')"></p>
               </div>

               <div class="medium-6 cell">
                  <label>Difficulty
                    <select aria-describedby="difficultyHelpText" v-model="Form.difficulty_id" required>
                      <option disabled selected>Select difficulty level</option>
                      <option :value="difficulty.id" v-for="difficulty in Data.difficulties" v-text="difficulty.level"></option>
                    </select>
                  </label>
                  <p class="help-text" id="difficultyHelpText" v-if="Form.errors.has('difficulty')" v-text="Form.errors.get('difficulty')"></p>
               </div>


               <div class="medium-6 cell">
                 <label>Duration
                   <input type="number" aria-describedby="durationHelpText" v-model="Form.duration" required>
                 </label>
                <p class="help-text" id="durationHelpText" v-if="Form.errors.has('duration')" v-text="Form.errors.get('duration')"></p>
               </div>

               <div class="medium-6 cell">
                 <label>Fee
                   <input type="number" aria-describedby="durationHelpText" v-model="Form.fee" required>
                 </label>
               <p class="help-text" id="durationHelpText" v-if="Form.errors.has('fee')" v-text="Form.errors.get('fee')"></p>
               </div>

               <div class="cell">
                 <label>Description
                   <textarea rows="6" id="descriptionHelpText" v-model="Form.description"></textarea>
                 </label>
               <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('description')" required v-text="Form.errors.get('description')"></p>
               </div>

               <div class="cell">
                 <label>Sypnosis
                   <textarea rows="4" id="descriptionHelpText" v-model="Form.sypnosis" required></textarea>
                 </label>
               <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('sypnosis')" v-text="Form.errors.get('sypnosis')"></p>
               </div>
             </div>
             <button type="submit" class="expanded medium button success" :disabled="Form.errors.any()">Create Course</button>
           </div>
        </form>

<!--Upload Course thumbnail-->
        <div v-if="step === 2" class="grid-container">
            <h5 class="center-text mt-2">Step Two <i class="fas fa-angle-double-right"></i>  Upload Course Thumbnail </h5>

            <p>Select Course thumbnail</p>
            <courseThumbnail :data="activeCourse"></courseThumbnail>
        </div>

        <!--Add other course details-->
        <div v-if="step === 3">
            <h5 class="center-text mt-2">Step Three <i class="fas fa-angle-double-right"></i>  Other Course Details </h5>

            <courseExtraDetails :data="activeCourse"></courseExtraDetails>

        </div>
        <div v-if="step === 4">
            <h5 class="center-text mt-2">Step Four <i class="fas fa-angle-double-right"></i>  Create Sections And Topics </h5>

            <courseSections :data="activeCourse"></courseSections>

        </div>

        <div class="grid-x grid-padding-x">
            <div class="medium-6 cell">
                <button type="submit" class="expanded medium button success" :disabled="Form.errors.any()" v-if=(previous) @click="previousStep">Previous</button>
            </div>
            <div class="medium-6 cell">
                <button type="submit" class="expanded medium button success" :disabled="Form.errors.any()" v-if=(next) @click="nextStep">Next</button>
            </div>
        </div>

    </div>
</template>

<script>
    import courseThumbnail from './courseThumbnail.vue';
    import courseExtraDetails from './courseExtraDetails.vue';
    import courseSections from './courseSections.vue';
    export default {

        components: {courseThumbnail, courseExtraDetails, courseSections},

        data () {
            return {
                active: '',
                previous: true,
                next: true,
                step: 1,
                totalSteps: 4,
                activeCourse: '',
                Form: new Form({
                    subject_id: '',
                    type_id: '',
                    difficulty_id: '',
                    title: '',
                    duration: '',
                    fee: '',
                    description: '',
                    sypnosis: ''
                }),
                Data: {
                    subjects: {},
                    types: {},
                    difficulties: {},
                }
            }
        },

        created () {
            axios.get('/api/courses')
                .then(response => this.Data.subjects = response.data);

            axios.get('/api/difficulties')
                .then(response => this.Data.difficulties = response.data);

            axios.get('/api/types')
                .then(response => this.Data.types = response.data);
        },

        methods: {
            addCourse () {
              this.Form.post('/courses')
                .then(data => {
                    this.activeCourse = data;
                        flash('Your course has been created.');
                        this.next = true;
                    }
                );
            },

            nextStep () {
                if (this.step < this.totalSteps) {
                    this.step++;
                }
            },

            previousStep() {
                if (this.step > 1) {
                    this.step--
                }
            }
        }
    }

</script>