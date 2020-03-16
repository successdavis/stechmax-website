<template>
    <div>
            <h5 class="center-text mt-2 gray-text" v-text="'Step ' + step + ' of ' + totalSteps"></h5>
            <meter :value="percentComplete" min="0" low="33" high="66" optimum="100" max="100" class="full-width"></meter>
            <form class="course_registration" @submit.prevent="addCourse" @keydown="Form.errors.clear()">
               <!-- =======================Course Registration Step One ================== -->
              <div v-if="step === 1">
                <h3 class="gray-text center-text mb-3 mt-2">First, let's find out what type of course you're making</h3>
                <div class="columns mb-3">
                    <label v-for="type in Data.types" class="column createCourseFlow--card" :class="Form.type_id === type.id ? 'createCourseFlow--card--active'  : ''" @click="setTypeTitle(type.name)">
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
              <div class="section">
                 <div>
                      <h4 class="gray-text center-text mt-2">What subject best fit your new {{selectedTypeTitle}}</h4>
                      <p class="center-text gray-text mb-2">If you're not sure about the right category, you can change it later. </p>

                      <div class="field">
                        <label class="label">Subject</label>
                        <div class="control">
                          <div class="select is-fullwidth">
                            <select class="is-fullwidth" v-model="Form.subject_id" required>
                                <option selected value="">Choose a Subject</option>
                                <option :value="subject.id" aria-describedby="subjectHelpText" v-for="subject in Data.subjects" v-text="subject.name"></option>
                            </select>
                          </div>
                        </div>
                        <p v-if="Form.errors.has('subject_id')" v-text="Form.errors.get('subject_id')" class="help is-danger"></p>
                      </div>
                 </div>

                  <div class="">
                      <h4 class="gray-text center-text mt-2">Give your new {{selectedTypeTitle}} a title</h4>
                      <p class="center-text gray-text mb-2">It's ok if you can't think of a good title now. You can change it later. </p>
                      <input class="input" type="text" placeholder="e.g. Learn Illustrator CCC from scratch" v-model="Form.title" required>

                    <p v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" class="help is-danger">This username is available</p>  
                  </div>      
              </div>
            </div>
            
            <!-- =======================Course Registration Step Three ================== -->
            <div v-if="step === 3">
               <div class="section">
                  <div class="columns is-multiline">

                    <!--  -->

                    <div class="column is-6">
                      <div class="field">
                        <label class="label">Difficulty Level</label>
                        <div class="control">
                          <div class="select is-fullwidth">
                            <select class="is-fullwidth" v-model="Form.difficulty_id">
                              <option disabled selected value="">Select difficulty level</option>
                              <option :value="difficulty.id" v-for="difficulty in Data.difficulties" v-text="difficulty.level"></option>
                            </select>
                          </div>
                        </div>
                         <p v-if="Form.errors.has('difficulty')" v-text="Form.errors.get('difficulty')" class="help is-success">This username is available</p>
                      </div>
                    </div>

                    <!--  -->

                    <div class="column">
                      <div class="field">
                          <label class="label">Whats the {{selectedTypeTitle}} duration (Specify in weeks)</label>
                          <div class="control">
                              <input class="input is-fullwidth is-success" type="text" v-model="Form.duration" placeholder="Type in figure e.g. 3 for 3 weeks">
                          </div>
                          <p v-if="Form.errors.has('duration')" v-text="Form.errors.get('duration')" class="help is-danger"></p>
                      </div>
                    </div>

                    <div class="column is-12">
                      <div class="field">
                        <label class="label">Tell us in details about your new {{selectedTypeTitle}}</label>
                        <div class="control">
                          <textarea v-model="Form.description" class="textarea" placeholder="Textarea"></textarea>
                        </div>
                        <p id="courseTitleHelpText" v-if="Form.errors.has('description')" required v-text="Form.errors.get('description')" class="help is-danger"></p>
                      </div>
                    </div>

                    <!--  -->

                    <div class="column is-12">
                      <div class="field">
                        <label class="label">Give us a little Sypnosis About your {{selectedTypeTitle}}</label>
                        <div class="control">
                          <textarea v-model="Form.sypnosis" required class="textarea" placeholder="Textarea"></textarea>
                        </div>
                        <p v-if="Form.errors.has('sypnosis')" v-text="Form.errors.get('sypnosis')" class="help is-danger">This email is invalid</p>
                      </div>
                    </div>
                  </div>
                <button type="submit" :class="processing ? 'is-loading' : ''" class="medium button success align-middle" :disabled="Form.errors.any()">Create Course</button>
               </div>
            </div>
        </form>

        <div class="section">
          <div class="columns">
              <div class="column">
                  <button type="submit" class="expanded medium button secondary" v-if="step > 1" @click="previousStep">Previous</button>
              </div>
              <div class="column">
                  <button type="submit" class="expanded medium button success" v-if="step < totalSteps" @click="nextStep">Next</button>
              </div>
          </div>
        </div>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                processing: false,
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
              this.processing = true;
              this.Form.post('/courses')
                .then(data => {
                        this.processing = false;
                        this.activeCourse = data;
                        flash('Your new' + this.selectedTypeTitle + ' has been created.');
                        window.location.href = '/dashboard/'+data.course.slug+'/manage';
                    }
                )
                .catch(error => {
                    this.processing = false;
                    flash('There was an issue creating your course', 'failed');
                });
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
