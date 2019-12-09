<template>
	<div id="path-header" class="bg--dark-blue align-middle">
		<div class="" v-if="playVideo" class="coursevideoplayer">
			<button class="button small play-back-btn" @click="playVideo = false">Close Video</button>
			<video-player :options="videoOptions"/> 
        </div>
	    <div class="grid-container path-info" v-if="! playVideo">
	             <a :href="'/courses/' + subject.slug" class="mb-3 tiny-button" v-text="subject.slug"></a>
	             <a :href="'/courses/'" class="mb-3 tiny-button" v-text="type"></a>

	             <div class="course__play--btn" :style="{backgroundImage: `url(${course.thumbnail_path})`}">
	                <i class="fas fa-play" @click="playVideo = true"></i>
	            </div>
	            <h3 class="mb-1 mt-1 course__streamer--title" v-text="course.title"></h3>
	            <p class="mb-3 course-desc" v-text="course.sypnosis"></p>
	            <div class="grid-x grid-padding-x mb-2">
                    <div class="cell medium-4" v-for="learn in learns" v-text="learn.body"></div>
	            </div> 
	            <div class="grid-x">
	                <div class="medium-6 cell">
	                    <h3 class="inline course__price">&#8358;<span v-text="course.amount / 100"></span></h3>
	                </div>
	                <div class="medium-6 cell">
	                    <a class="medium button course__info--sub-btn" :href="course_path + '/subscription?class=false'">Study Series Online</a>
	                    <a class="medium button course__info--sub-btn" :href="course_path + '/subscription?class=true'">Study Series Offline</a>
	                </div>
	            </div> 
	    </div>
	    <div class="hero-image" :style="{backgroundImage: `url(${course.thumbnail_path})`}"></div>
	</div>
</template>
<script>
	import VideoPlayer from "../components/VideoPlayer.vue";

	export default {
		// props: ['course','subject','learns','course_path','videoUrl']
		props: {
			course: Object,
			subject: Object,
			learns: Array,
			course_path: String,
			type: String,
			videoUrl: String
		},
		components: {
	        VideoPlayer
	    },

	    data() {
	    	return {
	    		playVideo: false,
	    		videoOptions: {
	                autoplay: true,
	                controls: true,
	                preload: 'auto',
	                // aspectRatio:"16:9", 
	                fluid: true,
	                playbackRates: [0.2, 0.5, 1, 1.5, 2,3,4],
	                sources: [
	                    { 
	                        src: this.video_path,
	                        type: "video/mp4"
	                    }
	                ],
	            },
	    	}
	    },

	    methods: {
	    	
	    }
	}
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