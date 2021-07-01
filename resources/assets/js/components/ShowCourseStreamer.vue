<template>
	<div id="path-header" class="bg--dark-blue align-middle">
		<div class="" v-if="playVideo" class="coursevideoplayer">
			<button class="button small play-back-btn" @click="playVideo = false">Close Video</button>
			<div class="grid-container">
				<vimeo-player :videoid="source" :autoplay="true"></vimeo-player>
			</div>
        </div>
	    <div class="container path-info" v-if="! playVideo">
	            <a :href="'/courses/' + subject.slug" class="mb-3 tiny-button" v-text="subject.slug"></a>
	            <a :href="'/courses/'" class="mb-3 tiny-button" v-text="type"></a>

	            <div @click="togglePlay" class="course__play--btn" :style="{backgroundImage: `url(${course.thumbnail_path})`}">
	                <i class="fas fa-play"></i> 
	            </div>
	            <h3 class="is-size-4-mobile mt-1 is-size-3 course__streamer--title" v-text="course.title"></h3>
	            <p class="mb-3 course-desc has-text-centered" v-text="course.sypnosis"></p>
<!-- 	            <div class="columns mb-2">
                    <div style="color: black;" class="column" v-for="learn in learns" v-text="learn.body"></div>
	            </div>  -->
	            <div v-if="course.isSubscribedBy">
		            <a :href="lecture_path" class="button medium">Watch Episodes</a>
	            </div>
	            <div v-if="! course.isSubscribedBy">
	            	<div class="columns is-mobile" v-if="course.available_online">
	            		<div class="column is-6" title="Register for online training">
	            			<!-- Add this href attribute to button if online training is allowed -->
	            			<!-- :href="course_path + '/subscription?class=false'" -->
	            			<a :href="signedIn ? course_path + '/subscription' : '#registration-login' " class="button is-link is-rounded is-fullwidth">Study Series Online</a>
	            			<span class="is-size-7 has-text-black">Online Training Only</span>

	            		</div>
	            		<div class="column is-6">
		                    <div class="has-text-warning is-size-4">&#8358;<span v-text="amount"></span></div>
	            		</div>
	            	</div>
	            	<div class="columns is-mobile" v-if="course.available_offline">
	            		<div class="column is-6" >
	            			<a :href="signedIn ? course_path + '/subscription?class=true' : '#registration-login' " class="button is-link is-rounded is-fullwidth">Study Series Offline</a>
	            			<span class="is-size-7 has-text-black">Online + Classroom Training</span>
	            		</div>
	            		<div class="column is-6">
		                    <div class="has-text-warning is-size-4">&#8358;<span v-text="classroomamount"></span></div>
	            		</div>
	            	</div>
<!-- 	            	<div class="columns is-mobile" v-if="course.available_lifetime">
	            		<div class="column is-6">
	            			<a :href="course_path + '/subscription?class=true'" class="button is-link is-rounded is-fullwidth">One off purchase</a>
	            			<span class="is-size-7 has-text-black">Online Lifetime Access</span>
	            		</div>
	            		<div class="column is-6">
		                    <div class="has-text-warning is-size-4">&#8358;<span v-text="classroomamount"></span></div>
	            		</div>
	            	</div> -->
	            </div>
	            <!-- <login-register></login-register> -->
	    </div>
	    <div class="hero-image" :style="{backgroundImage: `url(${course.thumbnail_path})`}"></div>
	</div>
</template>
<script>

	export default {
		// props: ['course','subject','learns','course_path','videoUrl']
		props: {
			course: Object,
			subject: Object,
			learns: Array,
			course_path: String,
			lecture_path: String,
			type: String,
			videourl: String,
			amount: Number,
			classroomamount: Number,
		},

	    data() {
	    	return {
	    		signedIn: false,
	    		playVideo: false,
	                source: this.course.video_path,
	    		playeroptions: {
	                autoplay: true,
	            },
	    	}
	    },

	    mounted() {
	    	this.signedIn = window.App.signedIn;
	    },

	    methods: {
	    	togglePlay() {
	        	Event.$emit('play');
	    		this.playVideo = true;
	    	}
	    }
	};
</script>

<style scoped="true">
	.coursevideoplayer {
		z-index: 2;
		position: relative;
	}
	.play-back-btn {
		position: absolute;
	    top: 6px;
	    left: 6px;
	    z-index: 2;
	    border-radius: 3px;
	    background: rgba(23,243,55,.4);
	    transition: .3s all;
	}

	.play-back-btn:hover {
	    padding-left: 2.5em;
	}
</style>