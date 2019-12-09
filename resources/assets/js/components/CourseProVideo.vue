<template>
	<div class="mt-2"> 
        <p class="grid-container">Course Video Details</p>     
        <div class="grid-x grid-container grid-padding-x">
            <div class="medium-8 thumbnail">
            	<div v-if="playerOptions.sources[0].src">
	                <video-player  class="video-player-box"
		                 ref="videoPlayer"
		                 :options="playerOptions"
		                 :playsinline="true"
		                 customEventName="customstatechangedeventname"
		                 @play="onPlayerPlay($event)"
		                 @pause="onPlayerPause($event)"
		                 @ended="onPlayerEnded($event)"
		                 @timeupdate="onPlayerTimeupdate($event)"

		                 @statechanged="playerStateChanged($event)"
		                 @ready="playerReadied">
				  	</video-player>
            	</div>
                <ul>
                    <!-- <li v-for="error in errors.thumbnail" v-text="error"></li> -->
                </ul>     
            </div>
            <div class="medium-4 grid-container">
                <p>Important guidelines: </p>
                File must be in Mp4 format
                <form method="POST" enctype="multipart/form-data" @submit.prevent="persist">
		            <label for="video" class="button small">Update Video</label>
			        <input @change="persist" type="file" id="video" class="show-for-sr" accept="video/*">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
	// import VideoPlayer from "../components/VideoPlayer.vue";
	export default {
        props: ['course'],

		// components: {
	 //        VideoPlayer
	 //    },

	    data() {
	    	return {
	    		player: '',
	    		playerOptions: {
	                autoplay: false,
	                language: 'en',
	                poster: this.course.thumbnail_path,
	                controls: true,
	                preload: 'auto',
	                // aspectRatio:"16:9", 
	                fluid: true,
	                playbackRates: [0.2, 0.5, 1, 1.5, 2,3,4],
	                sources: [
	                    { 
	                        src: this.course.video_path,
	                        type: "video/mp4"
	                    } 
	                ],
	            },
	    	}
	    },

	    mounted() {
	      console.log('this is current player instance object', this.player)
	    },
	    
	    methods: {
	        persist(e) {
		        	this.player.pause();
		        	if(! e.target.files.length) return;
	                let video = e.target.files[0];

	                let data = new FormData();

	                data.append('video', video);

	                axios.post(`/api/course/${this.course.title}/promovideo`, data)
                    .then(data => {
                    	flash('Video Uploaded Successfully!');
 						location.reload();
                    })
                    .catch(error => {
                    	flash('There are some errors with the video you provided','failed');
                    });
	        },

	        onPlayerPlay(player) {
		        // console.log('player play!', player)
		    },
		    
		    onPlayerPause(player) {
		        // console.log('player pause!', player)
		    },
		    // ...player event

		      // or listen state event
		    playerStateChanged(playerCurrentState) {
		        // console.log('player current update state', playerCurrentState)
		    },

		      // or listen state event
		    onPlayerTimeupdate(timeupdate) {
		        // console.log('player current update state', playerCurrentState)
		    },

		      // player is ready
		    playerReadied(player) {
		    	this.player = player;
		        console.log('the player is readied', player)
		        // you can use it to do something...
		        // player.[methods]
		        console.log(player.paused());
		    },
		      // player is ready
		    onPlayerEnded(player) {
		        console.log('the player is ended', player);
		        // you can use it to do something...
		        // player.[methods]
		    }
	    }
	}
</script>