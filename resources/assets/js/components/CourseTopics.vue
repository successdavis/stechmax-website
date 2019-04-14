<template>
    <div>
        <ul>
            <li v-for="topic in topics" v-text="topic.title"></li>
        </ul>
        <form action="" @submit.prevent="addTopic" @keydown="Form.errors.clear()">
            <div class="cell">
                <input type="text" aria-describedby="topicHelpText" v-model="Form.title" required>
                <!--<p class="help-text" v-if="learnForm.errors.has('learn')" v-text="learnForm.errors.get('body')" id="courseBenefitHelpText"></p>-->
                <!--<p class="help-text" v-if="learnForm.errors.has('learn')" v-text="learnForm.errors.get('course_id')" id="courseBenefitHelpText"></p>-->
            </div>
            <button type="submit" class="small button success" :disabled="Form.errors.any()">Add Topic</button>

        </form>

    </div>
</template>

<script>
    export default {
        props: ['section'],

        data () {
            return {
                topics: {},
                Form: new Form({
                    title: '',
                })
            }
        },

        created () {
            axios.get(`/courses/${this.section.course_id}/${this.section.id}/topic`)
                .then(response => this.topics = response.data)
        },

        methods: {
            addTopic () {
                this.Form.post(`/courses/${this.section.course_id}/${this.section.id}/topic`)
                    .then(data => {
                            this.topics.unshift(data);
                            flash('New Topic Created')
                        }
                    );
            }
        }
    }
</script>