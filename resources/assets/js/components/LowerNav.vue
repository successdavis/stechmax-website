<script>
	export default {
		mounted() {
			let originalOffsetTop = this.$refs['lower-navigation'].offsetTop;

			window.addEventListener('scroll', () => {
				if (window.scrollY >= originalOffsetTop) {
					this.$refs['lower-navigation'].classList.add('is-fixed-to-top');
				}else {
					this.$refs['lower-navigation'].classList.remove('is-fixed-to-top');
				}
			})
		}
	}
</script>