<template>
    <div>
            <h5 class="center-text mt-2 gray-text" v-text="'Step ' + step + ' of ' + totalSteps"></h5>
            <meter :value="percentComplete" min="0" low="33" high="66" optimum="100" max="100" class="full-width"></meter>
            <form class="course_registration" @submit.prevent="addCourse" @keydown="Form.errors.clear()">
               <!-- =======================Course Registration Step One ================== -->
              <div v-if="step === 1">
                <h3 class="gray-text center-text mb-3 mt-2">First, let's find out what type of course you're making</h3>
                <div class="grid-x grid-padding-x align-center mb-3">
                    <label v-for="type in Data.types" class="cell medium-3 createCourseFlow--card" :class="Form.type_id === type.id ? 'createCourseFlow--card--active'  : ''" @click="setTypeTitle(type.name)">
                      <img class="icon" :src="type.icon_path" alt="Icon">
                      <div class=" center-text">
                        <input type="radio" :value="type.id" id="course" v-model="Form.type_id">
                          <h4 v-text="type.name"></h4>
                          <p class="center-text" v-text="type.description"></p>
                      </div>
                    </label>
                </div>
              </div>

               <!-- =======================Course Registration Step Two ================== -->

            <div v-if="step === 2" class="mb-3">
              <div class="grid-container">
               <div class="grid-x grid-padding-x">
                 <div class="cell">
                      <h4 class="gray-text center-text mt-2">What subject best fit your new {{selectedTypeTitle}}</h4>
                      <p class="center-text gray-text mb-2">If you're not sure about the right category, you can change it later. </p>
                    <label>
                      <select aria-describedby="subjectHelpText" v-model="Form.subject_id" required>
                      <option selected value="">Choose a Subject</option>
                        <option :value="subject.id" aria-describedby="subjectHelpText" v-for="subject in Data.subjects" v-text="subject.name"></option>
                      </select>
                    </label>
                    <p class="help-text" v-if="Form.errors.has('subject_id')" v-text="Form.errors.get('subject_id')" id="subjectHelpText"></p>
                 </div>

                 <div class="cell">
                      <h4 class="gray-text center-text mt-2">Give your new {{selectedTypeTitle}} a title</h4>
                      <p class="center-text gray-text mb-2">It's ok if you can't think of a good title now. You can change it later. </p>
                   <label>
                     <input type="text" placeholder="e.g. Learn Illustrator CCC from scratch" aria-describedby="courseTitleHelpText" v-model="Form.title" required>
                   </label>
                 <p class="help-text" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="courseTitleHelpText"></p>
                 </div>          
              </div>
                <!-- <button type="submit" class="expanded medium button success" :disabled="Form.errors.any()">Create Course</button> -->
              </div>
            </div>
            
            <!-- =======================Course Registration Step Three ================== -->
            <div v-if="step === 3">
               <div class="grid-container">
                  <div class="grid-x grid-padding-x">
                    <div class="medium-6 cell">
                        <label>Difficulty Level
                           <select aria-describedby="difficultyHelpText" v-model="Form.difficulty_id" required>
                              <option disabled selected value="">Select difficulty level</option>
                              <option :value="difficulty.id" v-for="difficulty in Data.difficulties" v-text="difficulty.level"></option>
                           </select>
                          </label>
                        <p class="help-text" id="difficultyHelpText" v-if="Form.errors.has('difficulty')" v-text="Form.errors.get('difficulty')"></p>
                     </div>
                    <div class="medium-6 cell">
                        <label>Whats the {{selectedTypeTitle}} duration (Specify in Months)
                           <input type="number" aria-describedby="durationHelpText" v-model="Form.duration" placeholder="Type in figure e.g. 3 for 3 weeks" required>
                        </label>
                        <p class="help-text" id="durationHelpText" v-if="Form.errors.has('duration')" v-text="Form.errors.get('duration')"></p>
                    </div>
                    <div class="cell">
                        <label>Tell us in details about your new {{selectedTypeTitle}}
                           <textarea placeholder="The information you type here can be change later" rows="6" id="descriptionHelpText" v-model="Form.description"></textarea>
                        </label>
                        <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('description')" required v-text="Form.errors.get('description')"></p>
                    </div>

                    <div class="cell">
                        <label>Give us a little Sypnosis About your {{selectedTypeTitle}}
                           <textarea placeholder="The information you type here can be change later" rows="4" id="descriptionHelpText" v-model="Form.sypnosis" required></textarea>
                        </label>
                        <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('sypnosis')" v-text="Form.errors.get('sypnosis')"></p>
                    </div>
                  </div>
                <button type="submit" class="medium button success align-middle" :disabled="Form.errors.any()">Create Course</button>
               </div>
            </div>
        </form>

        <div class="grid-x grid-padding-x">
            <div class="medium-6 cell">
                <button type="submit" class="expanded medium button secondary" v-if="step > 1" @click="previousStep">Previous</button>
            </div>
            <div class="medium-6 cell">
                <button type="submit" class="expanded medium button success" v-if="step < totalSteps" @click="nextStep">Next</button>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                activeCourse: '',
                percentComplete: 0,
                step: 1,
                totalSteps: 3,
                selectedTypeTitle: '',
                Form: new Form({
                    subject_id: '',
                    type_id: '',
                    difficulty_id: '',
                    title: '',
                    duration: '',
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

            this.percentComplete = 100 / this.totalSteps;
        },

        methods: {
            addCourse () {
              this.Form.post('/courses')
                .then(data => {
                        this.activeCourse = data;
                        flash('Your new' + this.selectedTypeTitle + ' has been created.');
                        window.location.href = '/dashboard/'+data.course.id+'/manage';
                    }
                );
            },

            nextStep () {
                if (this.step < this.totalSteps) {
                    this.step++;
                    this.increasePercentage();
                }
            },

            previousStep() {
                if (this.step > 1) {
                    this.step--
                    this.decreasePerecentage();
                }
            },

            increasePercentage() {
               let increase = 100 / this.totalSteps;
               console.log(increase);
               this.percentComplete += increase;
            },

            decreasePerecentage () {
               let increase = 100 / this.totalSteps;
               this.percentComplete -= increase;
            },

            setTypeTitle(title) {
               this.selectedTypeTitle = title;
            }
        }
    }

</script>
