<template>
	<div class="container">
		<section class="section">
			<div class="mb-3">
				<newnewsletter></newnewsletter>
			</div>
			<div class="columns">
				<div class="column is-9">
					<news v-for="(news, index) in dataSet" :news="news" :key="index"></news>
				</div>
				<div class="column is-3"></div>
			</div>
		</section>
	</div>
	
</template>
<script>
    import news from '../components/news';

	export default {
		components: {news},
		data () {
			return {
				dataSet: '',
			}
		},

		mounted () {
			axios.get('/newsletter')
			.then((data) => {
				this.dataSet = data.data; 
			})
			.catch(() => {
				flash('unable to retrieve data');
			})
		}
	}
</script>