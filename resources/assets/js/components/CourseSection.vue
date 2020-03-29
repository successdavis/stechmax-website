<template>
    <div>
        <transition 
            name="custom-classes-transition"
            enter-active-class="animated fadeIn fast"
            leave-active-class="animated fadeOut fast"
        >
            <form v-if="editing === true" @submit.prevent="update" @keydown="Form.errors.clear()" @keydown.enter.prevent="createSection">
                <label>Edit Section Title</label>
                <input type="text" v-model="Form.title">
                <p class="help-text" v-if="Form.errors.has('title')" v-text="Form.errors.get('title')" id="description"></p>

                <label>What will students be able to do at the end of this section?</label>
                <input type="text" v-model="Form.description" placeholder="Enter a learning objective">
                <p class="help-text" v-if="Form.errors.has('description')" v-text="Form.errors.get('description')" id="description"></p>

                <button @click.prevent="editing = false" type="cancel">Cancel</button>
                <button type="submit" class="small button" :disabled="Form.errors.any()">Update</button>
            </form>
        </transition>

        <div class="course-section floating-button-body" v-if="editing === false">
            <div class="mb-2 display-mini-icons">
                <span class="bold"><strong>Section {{index + 1}}: </strong></span>
                <p v-text=" Form.title" class="inline"></p>
                <span>
                    <i class="far fa-edit mini-icons" @click="editing = true"></i>
                    <i class="fas fa-trash mini-icons" @click="remove"></i>
                </span>
            </div>

            <div style="padding-left: 2em">
                <draggable :list="lectures"  :element="'div'" @change="reOrderLectures">
                    <transition-group type="transition" name="flip-list">
                        <div v-for="(lecture, index) in lectures" :key="lecture.id">
                            <Lecture :lecture="lecture, index" @deleted="removeLecture(index)"></Lecture>
                        </div>
                    </transition-group>
                </draggable>

                <transition 
                    name="custom-classes-transition"
                    enter-active-class="animated fadeInUp faster"
                    leave-active-class="animated fadeOutDown faster"
                >
                    <NewLecture v-if="addingLecture" :section="section" @cancel="addingLecture = false" @created="addLecture"></NewLecture>
                </transition>
            </div>
            <div v-if="!addingLecture" class="floating-button add-lecture-button" @click="addingLecture = true">Add</div>
        </div>

    </div>
</template>

<script>
    import SectionLecture from './SectionLecture.vue';
    import NewLecture from './NewLecture.vue';
    import Lecture from './Lecture.vue';

    export default {
        components: {NewLecture, SectionLecture, Lecture},

        props: ['section', 'index'],

        data () {
            return {
                lectures: this.section.lectures,
                editing: false,
                addingLecture: false,
                id: this.section.id,
                Form: new Form({
                    title: this.section.title,
                    description: this.section.description
                })
            }
        },
        // mounted () {
        //     axios.get(`/manage/${this.section.id}/lectures`)
        //         .then(response => this.lectures = response.data)
        // },
        methods: {
            addLecture (lecture) {
                this.lectures.push(lecture);
                this.addingLecture = false;
            },

            removeLecture (index) {
                this.lectures.splice(index, 1);
                this.reOrderLectures();
            },

            reOrderLectures () {
                this.lectures.map((lecture, index) => {
                    lecture.order = index + 1;
                })

                axios.put(`/manage/${this.section.id}/lectures`, {
                    lectures: this.lectures
                }).then((response) => {
                    console.log(response);
                })
            },

            remove () {
                axios.delete(`/manage/${this.id}/section`);

                this.$emit('deleted');
            },

            update() {
                this.Form.patch(`/manage/${this.id}/section`);

                this.editing = false;
            },
        }
    }
</script>

