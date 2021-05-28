<template>
	<div class="mt-2"> 
        <p>Course Video Details</p>     
        <div class="columns">
            <div class="column is-8">
				<div id="myVideo"></div>
            </div>
            <div class="column grid-container"> 
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
	import Player from '@vimeo/player'
	export default {
		components: {Player},
        props: ['course'],
	    data() {
	    	return {
	    		height: 640,
                source: this.course.video_path,
	    		options: {
	    			id: this.course.video_path,
	                autoplay: true,
	            },
	            player: false
	    	}
	    },

	    mounted() {
	    	this.install()
	    },

	    methods: {
	    	install() {
		      this.player = new Player( 'myVideo' , {
		          id: this.source,
		          width: 1920,
		          height: 1080,
		          background: 'black',
		      })
		      .on("ended", function() {
		            console.log('video ended!')
		        })
		    },
	        persist(e) {
		        	Event.$emit('paused');

		        	if(! e.target.files.length) return;
	                let video = e.target.files[0];

	                let data = new FormData();

	                data.append('video', video);

	                axios.post(`/api/course/${this.course.slug}/promovideo`, data)
                    .then(data => {
                    	flash('Video Uploaded Successfully!');
 						location.reload();
                    })
                    .catch(error => {
                    	flash('There are some errors with the video you provided','failed');
                    });
	        },
	    }
	}
</script>