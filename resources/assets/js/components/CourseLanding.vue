<template>
    <div>
        <button class="button top-right-button" :disabled="!save" @click="persist">Save</button>
        <form @submit.prevent="" @keydown="Form.errors.clear()" @change="save = true" >
            <div class="grid-x grid-padding-x">
            <div class="cell">
                <label for="title">Course Title
                    <input id="title" type="text" v-model="Form.title">
                    <p class="help-text" v-if="Form.errors.has('title')" required v-text="Form.errors.get('title')"></p>
                </label>
            </div>

            <div class="cell">
                <label>Course Description
                   <textarea placeholder="The information you type here can be change later" rows="6" id="descriptionHelpText" v-model="Form.description"></textarea>
                </label>
                <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('description')" required v-text="Form.errors.get('description')"></p>
            </div>

            <div class="cell">
                <label>Course Subtitle
                   <textarea placeholder="The information you type here can be change later" rows="4" id="descriptionHelpText" v-model="Form.sypnosis" required></textarea>
                </label>
                <p class="help-text" v-if="Form.errors.has('sypnosis')" v-text="Form.errors.get('sypnosis')"></p>
            </div>
            
            <div class="medium-4 cell">
                <label>Course Difficulty
                    <select v-model="Form.difficulty_id">
                        <option >--Select Level--</option>
                        <option :value="difficulty.id" v-for="difficulty in difficulties" v-text="difficulty.level"></option>
                    </select>
                </label>
                <p class="help-text" v-if="Form.errors.has('difficulty_id')" required v-text="Form.errors.get('difficulty_id')"></p>

            </div>
            <div class="medium-4 cell">
                <label> Course Subject
                    <select v-model="Form.subject_id">
                        <option >--Select Subject--</option>
                        <option :value="subject.id" v-for="subject in subjects" v-text="subject.name"></option>
                    </select>
                </label>
                <p class="help-text" v-if="Form.errors.has('subject_id')" required v-text="Form.errors.get('subject_id')"></p>

            </div>
            <div class="medium-4 cell">
                <label>Whats the duration (Specify in weeks)
                   <input type="number" aria-describedby="durationHelpText" v-model="Form.duration" placeholder="Type in figure e.g. 3 for 3 weeks" required>
                </label>
                <p class="help-text" id="durationHelpText" v-if="Form.errors.has('duration')" v-text="Form.errors.get('duration')"></p>
            </div>
            <div class="medium-4 cell">
                <label>Course Fee
                   <input type="number" aria-describedby="durationHelpText" v-model="Form.amount" placeholder="What is the cost fee for this course" required>
                </label>
                <p class="help-text" id="durationHelpText" v-if="Form.errors.has('amount')" v-text="Form.errors.get('amount')"></p>
            </div>
        </div>

        </form>
        <CourseThumbnail :data="course" :path="path"></CourseThumbnail>
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
              this.Form.patch(`/courses/${this.course.id}`)
                .then(data => {
                        flash('Your changes have been saved');
                    }
                );
            },
        }
    }

</script>
