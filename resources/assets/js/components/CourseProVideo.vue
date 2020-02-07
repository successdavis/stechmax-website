<template>
	<div class="mt-2"> 
        <p class="grid-container">Course Video Details</p>     
        <div class="grid-x grid-container grid-padding-x">
            <div class="medium-8 thumbnail">
            	<vid-player :playerdata="playerdata"></vid-player>
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
	export default {
        props: ['course'],
	    data() {
	    	return {
	    		player: '',
	    		playerdata: {
	                source: this.course.video_path,
	                autoplay: false,
	                playlist: [{
                		sources: [{
                			src: this.course.video_path,
		                    type: 'video/mp4'
                		}],
                		poster: this.course.thumbnail_path,
                	}],
	            },
	    	}
	    },

	    methods: {
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