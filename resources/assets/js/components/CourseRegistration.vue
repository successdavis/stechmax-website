<template>
    <form class="course_registration" @submit.prevent="addCourse" @keydown="Form.errors.clear()">
           <div class="grid-container">

            <h5 class="center-text mt-2">Course Registration</h5>

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
             <button type="submit" class="expanded medium button success" :disabled="Form.errors.any()" v-if=(next)>Next</button>
           </div>
         </form>
</template>

<script>
    export default {
        data () {
            return {
                next: false,
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
                  difficulties: {}
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
                .then(() => 
                    flash('Your course has been created.')
                  );
            }
        }
    }

</script>
