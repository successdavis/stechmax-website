<template>
	<div>
		<section class="relative is-danger has-background-black is-fullheight-with-navbar">
				<div class="player_size has-background-black">
			    	<vimeo-player :videoid="lectureid" :autoplay="true" @videoend="playnext()"></vimeo-player>
				</div>
				<div v-if="showcounter" class="showcounter">
						<numberCountdown :startfrom="5" @finished = "nextEpisode"></numberCountdown>
						<div>
							<button class="button small is-info" @click="showcounter = false">Cancel</button>
							<button class="button small is-success" @click="nextEpisode">next</button>
						</div>
				</div>
		</section>
		<div class="columns">
			<div class="column is-6">
				<button class="button is-medium is-fullwidth" v-show="prevepisodeslug" @click="previousEpisode">Previous Episode</button>
			</div>
			<div class="column is-6">
				<button class="button is-medium is-fullwidth" v-show="nextepisodeslug" @click="nextEpisode">Next Episode</button>
			</div>
		</div>
	</div>
</template>
<script>
import numberCountdown from '../components/numberCountdown.vue';
export default {
  components: {numberCountdown},
	props: {
		lecture: {required: true}, 
		nextepisode: {type: [String], default: false}, 
		prevepisode: {type: [String], default: false} 
	},
	data () {
		return {
			lectureid: this.lecture.video_path,
			nextepisodeslug: this.nextepisode,
			prevepisodeslug: this.prevepisode,
			autoPlay: false,
			showcounter: false,
		}
	},

	methods: {
		playnext() {
			if (this.nextepisodeslug) {
				this.showcounter = true;
			}
		},

		nextEpisode() {
			if (this.nextepisodeslug) {
				return window.location.href = this.nextepisodeslug;
			}
		},

		previousEpisode() {
			if (this.prevepisodeslug) {
				window.location.href = this.prevepisodeslug;
			}
		}
	}
};
	
</script>
<style scoped>
	.showcounter {
		display: flex;
		flex-direction: column;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.relative {
		position: relative;
	}
	@media only screen and (min-width: 1300px) {
		.player_size {
			width: 1024px;
			margin: auto;
		}
	}
</style>