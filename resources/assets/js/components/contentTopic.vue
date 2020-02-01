<template>
	<div>
		<i class="far fa-play-circle"></i> 
		<span v-text="title" style="cursor: pointer;"></span>
	</div>
</template>

<script>

	export default {
		props: ['topic'],

		data () {
			return {
				title: this.topic.title,
			}
		},
	}
</script>