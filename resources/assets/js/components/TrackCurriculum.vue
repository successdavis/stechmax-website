<template>
    <div class="grid-container">
        <div>
        <draggable :list="trackCourses" :element="'div'" @change="reOrderCourses">
            <div class="grid-x track-list" v-for="(course, index) in trackCourses" :key="course.id">
                <div class="floating-button-body medium-11">
                    <div v-text="course.title" class="cell"></div>
                    <span class="medium-2 track floating-button buttons-right">
                        <i class="far fa-trash-alt c_buttons c_buttons--pointer" @click="deleteItem(index, course.id)"></i>
                        <i class="fas fa-arrows-alt c_buttons--move handle" title="Drag this button to re-order items"></i>
                    </span>
                </div>
            </div>
        </draggable>
            
        <modal name="addToTrack" height="523px" draggable=".window-header">
            <div class="scrollable">                
                <div class="window-header">DRAG ME HERE</div>
                <div slot="top-right">
                    <button @click="$modal.hide(modal)">
                        ❌
                    </button>
                </div>
                <div class="grid-container">
                        <div class="grid-x track-list" v-for="(course, index) in courses" :key="course.id">
                            <div class="floating-button-body small-11">
                                <div v-text="course.title" class="cell"></div>
                                <span class="medium-2 track floating-button buttons-right">
                                    <i class="fas fa-plus-square button-plus-sign c_buttons--pointer" @click="addToTrackCourses(course)"></i>
                                </span>
                            </div>
                        </div>
                </div>
            </div>
        </modal>

            <button @click="$modal.show('addToTrack')" class="button small success">Add Course</button>
        </div>
    </div>
</template>

<script>
    import courseTopics from './courseTopics.vue';
    import courseSection from './courseSection.vue';

    export default {
        components: {courseTopics, courseSection},

        props: ['course'],

        data () {
            return {
                addingCourse: false,
                courses: [],
                trackCourses: [],
            }
        },

        computed: {

        },

        methods: {
            cancel () {
                this.addingSection = false;
            },

            deleteItem(index, course_id) {
                axios.delete(`/tracks/${this.course.id}/delete`, { data: { id: course_id } });
                
                this.trackCourses.splice(index, 1);
                this.reOrderCourses();
            },

            addToTrackCourses (course) {
                axios.post(`/tracks/${this.course.id}/addcourse`, {
                    id: course.id
                }).then(data => {
                    flash(course.title + ' link to track')
                    this.trackCourses.push(course)
                }).catch(error => {
                    flash('We could not process your request. Duplicates not allowed')
                });
            },

            reOrderCourses () {
                this.trackCourses.map((course, index) => {
                    course.order = index + 1;
                })
                axios.put(`/tracks/${this.course.id}/reOrderCourses`, {
                    courses: this.trackCourses
                }).then((response) => {
                    console.log(response);
                })
            },
        },


        mounted () {
            axios.get(`/api/courses/allcourses`)
                .then(response => this.courses = response.data),

            axios.get(`/api/courses/${this.course.id}/getcourses`)
                .then(response => this.trackCourses = response.data)
        }
    }

</script>
