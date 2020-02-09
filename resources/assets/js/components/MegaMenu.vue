<template>
    <div class="navbar-item has-dropdown" @mouseover="active = true" @mouseout="active = false">
        <a class="navbar-link" href="/courses">
          LIBRARY
        </a>
        <portal to="megamenu">
            <div class="mega-menu" v-show="active" @mouseover="active = true" @mouseout="active = false">
                <div class="container">
                    <div  class="columns" style="padding: 1.5em;"> 
                        <ul class="column megamenu_subject">
                            <li v-for="(subject, index) in subjects" @mouseover="selectCourse(subject)" :class="selected.id === subject.id ? 'subject-is-active' : 'classname' ">
                                <a :href="'/courses/'+subject.slug" v-text="subject.name"></a>
                            </li>
                        </ul>
                        <div class="column is-three-quarters">
                            <div class="columns"v-if="selected">
                                <div class="column is-6">
                                    <div>Courses</div>
                                    <ul>
                                        <li v-for="course in courses">
                                            <a href="" v-text="course.title"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="column is-6">
                                    <div>Tracks</div>
                                    <ul>
                                        <li v-for="track in tracks">
                                            <a href="" v-text="track.title"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </portal>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                active: false,
                subjects: {},
                selected: {},
            }
        },

        computed: {
            courses() {
                return this.selected.courses.filter(course => course.type_id == 1);
            },

            tracks() {
                return this.selected.courses.filter(course => course.type_id == 2);
            },
        },

        created() {
            axios.get('/api/courses').then(response => this.setSelected(response.data));
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