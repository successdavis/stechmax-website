<script>
export default {
	props: ['course','sections'],
	data () {
		return {
			player: '',
			playlist: '',
			playVideo: false,
			currentItem: 0,
		}
	},

	computed: {
		playerdata() {
			let playlist = []
			this.sections.map((section) => {
				section.lectures.map((lecture) => {
					playlist.push({
						sources: [{
							src: lecture.VideoUrl,
							type: 'video/mp4'
						}],
		                poster: this.course.thumbnail_path,

					})
				})
			})

	        return {
                source: this.course.video_path,
                autoplay: false,
                playlist: playlist
            }
	    }
	},

	methods: {
		readied(player) {
			this.player = player;
			this.playlist = player.playlist;
		},
		lectureIndex(lecture) {
			if (this.playlist) {
				return this.playlist.indexOf(lecture.VideoUrl) == this.playlist.currentIndex();
			}
		},
		skipto(lecture){
            this.playlist.currentItem(this.playlist.indexOf(lecture.VideoUrl));
		},

		updateNowPlaying(e) {
			this.currentItem = e;
		}
	}
};
</script>

<style scoped>
	.study_section {
		padding: 1em;
	    background: burlywood;
	    font-weight: 600;
	}

	.study_section_lecture {
		padding: 1em;
	    cursor: pointer;
	}

	.study_section_lecture:hover {
		background-color: bisque;
	}

	.study_section_lecture.playing {
	    background: cadetblue;
	}
</style>