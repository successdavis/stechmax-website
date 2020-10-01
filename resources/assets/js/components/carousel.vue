<template>
	<div>
		<slot></slot>
	</div>

</template>

<script>
	import Flickity from 'flickity';
	import 'flickity/dist/flickity.min.css';

	export default {
		props: {
			autoplay: {default: false},
			wraparound: {default: false},
			pageDots: {default: true},
			prevNextButtons: {default: true},
		},

		mounted() {
			new Flickity(this.$el, {
				wrapAround: this.wraparound,
				autoPlay: this.autoplay,
				contain: true,
				cellAlign: 'left',
                pageDots: this.pageDots,
                prevNextButtons: this.prevNextButtons,
				// groupCells: true
			});
		}

	}
</script>
