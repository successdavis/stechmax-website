<template>
    <div>

        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              Course landing Page
            </p>
            <a href="#" class="card-header-icon" aria-label="more options">
                <button class="button" :disabled="!save" @click="persist">Save</button>
            </a>
          </header>
          <div class="card-content">
            <div class="content">
                <!--  -->
                <form @submit.prevent="" @keydown="Form.errors.clear()" @change="save = true" >
                    <div class="columns is-multiline">
                        <div class="column is-12">
                            <div class="field">
                              <label class="label">Course Title</label>
                              <div class="control">
                                <input id="title" class="input" type="text" v-model="Form.title">
                                <p class="help is-danger" v-if="Form.errors.has('title')" required v-text="Form.errors.get('title')"></p>
                              </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column is-12">
                            <div class="field">
                                <label class="label">Course Description</label>
                                <div class="control">
                                    <textarea class="textarea" placeholder="The information you type here can be change later" rows="6" v-model="Form.description"></textarea>
                                </div>
                                <p class="help is-danger" id="courseTitleHelpText" v-if="Form.errors.has('description')" required v-text="Form.errors.get('description')"></p>
                            </div>
                        </div>
                        <!--  -->
                        <div class="column is-12">
                            <div class="field">
                                <label>Course Subtitle</label>
                                <div class="control">
                                   <textarea class="textarea" placeholder="The information you type here can be change later" rows="4" v-model="Form.sypnosis" required></textarea>
                                </div>
                                <p class="help is-danger" v-if="Form.errors.has('sypnosis')" v-text="Form.errors.get('sypnosis')"></p>
                            </div>
                        </div>
                    
                        <div class="column is-4">
                            <div class="field">
                                <label>Course Difficulty</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select class="is-fullwidth" v-model="Form.difficulty_id">
                                            <option >--Select Level--</option>
                                            <option :value="difficulty.id" v-for="difficulty in difficulties" v-text="difficulty.level"></option>
                                        </select>
                                    </div>
                                </div>
                                <p class="help is-danger" v-if="Form.errors.has('difficulty_id')" required v-text="Form.errors.get('difficulty_id')"></p>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field">
                                <label> Course Subject</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select class="is-fullwidth" v-model="Form.subject_id">
                                            <option >--Select Subject--</option>
                                            <option :value="subject.id" v-for="subject in subjects" v-text="subject.name"></option>
                                        </select>
                                    </div>
                                </div>
                                <p class="help is-danger" v-if="Form.errors.has('subject_id')" required v-text="Form.errors.get('subject_id')"></p>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field">
                                <label>Whats the duration (Specify in weeks)</label>
                                <div class="control">
                                    <input class="input" type="number" aria-describedby="durationHelpText" v-model="Form.duration" placeholder="Type in figure e.g. 3 for 3 weeks" required>
                                    <p class="help-text" id="durationHelpText" v-if="Form.errors.has('duration')" v-text="Form.errors.get('duration')"></p>
                                </div>
                            </div>
                        </div>

                        <div class="column is-4">
                            <div class="field">
                                <label>Course Fee</label>
                                <div class="control">
                                   <input type="number" class="input" v-model="Form.amount" placeholder="What is the cost fee for this course" required>
                                </div>
                            </div>
                            <p class="help is-danger" id="durationHelpText" v-if="Form.errors.has('amount')" v-text="Form.errors.get('amount')"></p>
                        </div>
                    </div>
                </form>
                <CourseThumbnail :data="course" :path="path"></CourseThumbnail>
                <promo-video :course="course"></promo-video>
                 <!--  -->
            </div>
          </div>
        </div>
    </div>
</template>
<script>
    import CourseThumbnail from './CourseThumbnail.vue'
    export default {
        components: {
            CourseThumbnail
        },
        props: ['course', 'path'],
        data () {
            return {
                save: false,
                difficulties: [],
                subjects: [],
                Form: new Form({
                    title: this.course.title,
                    description: this.course.description,
                    difficulty_id: this.course.difficulty_id,
                    subject_id: this.course.subject_id,
                    sypnosis: this.course.sypnosis,
                    duration: this.course.duration,
                    amount: this.course.amount
                }),
            }
        },

        created () {
            axios.get('/api/courses')
                .then(response => this.subjects = response.data);

             axios.get('/api/difficulties')
                .then(response => this.difficulties = response.data);
        },

        methods: {
            persist () {
                this.save = false;
              this.Form.patch(`/courses/${this.course.slug}`)
                .then(data => {
                        flash('Your changes have been saved');
                    }
                );
            },
        }
    }

</script>
