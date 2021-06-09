<template>
	<div>
		<center>
			<span class="count" v-model="currentNumber" v-text="currentNumber"></span>
		</center>
	</div>
</template>
<script>
	export default {
		props: ['startfrom'],
		data () {
			return {
				currentNumber: this.startfrom,
			}
		},

		mounted() {
			let interval = setInterval(() => {
				this.countdown();
			}, 1000);

			this.$on('finished', () => clearInterval(interval));
		},

		methods: {
			countdown() {
				if (this.currentNumber > 0) {
					return this.currentNumber --
				}

				if (this.currentNumber <= 0 ) {
					this.$emit('finished');
				}
			}
		}
	};
</script>
<style>
	.count {
		font-size: 3em;
	}
</style>