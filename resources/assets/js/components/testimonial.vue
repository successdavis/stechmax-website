<template>
	<div>
		<p></p>
	</div>
</template>

<script>
	export default {
		props: ['testimonial'],

		data () {
			return {
				processing: false,
				Post: new Form({
					testimonial: '',
				}),
			}
		},
	}
</script>