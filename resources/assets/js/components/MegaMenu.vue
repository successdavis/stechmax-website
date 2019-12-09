<template>
    <div @mouseover="active = true" @mouseout="active = false">
        <a href="/courses" data-toggle="library-dropdown">LIBRARY  <i class="fas fa-angle-double-down"></i></a>

            <div class="mega-menu" @mouseover="active = true" @mouseout="active = false"  v-show="active">
                <div class="grid-x">
                    <!-- Subjects Container  -->
                    <div class="subject-container small-3">
                        <ul>
                            <li v-for="subject in subjects" @mouseover="selectCourse(subject)" :class="selected.id === subject.id ? 'subject-is-active' : 'classname' ">
                                <a :href="'/courses/'+subject.slug" v-text="subject.name"></a>
                            </li>
                        </ul>
                    </div>

                    <!-- Subject contents displayed to the right -->
                    <div class="small-9 grid-x">
                        <div class="small-6">
                            <span class="subject-container__header">Course</span>
                            <ul>
                                <li v-for="course in courses">
                                    <a :href="'/courses/'+selected.name + '/' +course.title" v-text="course.title" v-if="course.type_id == 1"></a>
                                </li>
                            </ul>
                        </div>

                        <div class="small-6">
                            <span class="subject-container__header">Learning Path</span>
                            <ul>
                                <li v-for="course in courses">
                                    <a :href="'/courses/'+selected.name + '/' +course.title" v-text="course.title" v-if="course.type_id == 2"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import _ from 'lodash';
export default {
    data () {
        return {
            active: false,
            subjects: {},
            selected: {},
        }
    },

    created() {
        axios.get('/api/courses').then(response => this.setSelected(response.data));
    },

    computed: {
        courses () {
            for (var i = this.subjects.length - 1; i >= 0; i--) {
                if (this.selected.id == this.subjects[i].id) {
                    return this.subjects[i]['courses'];
                    // data = this.subjects[i]['courses'];
                }
            }
        },
    },

    methods: {
        selectCourse(subject) {
            this.selected = subject;
        },

        setSelected(response) {
            // console.log(response);
            this.subjects = response;
            this.selected = this.subjects[0];
        }
    }
}
</script>
