<template>
	<div>
		<h3>Course Content</h3>
		<div class="columns">
		    <ul>
	            <div v-for="(section, index) in sections" :key="section.id">
	                <a class="front-end-section relative-body">
	                	<i class="far fa-file-alt"></i> <strong>Section {{index + 1}}: </strong>
	                	<span v-text="section.title"></span> 
	                	<i class="fas fa-long-arrow-alt-down top-right-button"></i>
	                </a>
	                <div>
                        <div v-for="(topic, index) in section.lectures" :key="topic.id" class="front-end-course">
                        	<section-topic :topic="topic"></section-topic>
                        </div>
	                </div>
		        </div>
		    </ul>
		</div> 
	</div>
</template>
<script>
	export default {
        props: ['course'],

		data() {
			return {
                sections: [],
			}
		},

		mounted () {
            axios.get(`/manage/${this.course.slug}/sections`)
                .then(response => this.sections = response.data)
        }
	}
</script>