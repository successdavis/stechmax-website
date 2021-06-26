<template>
	<section>
		<div class="columns">
			<div class="column is-2">
				 <span v-text="news.purpose"></span> -
				 <span v-text="news.type"></span>
			</div>
			<div class="column">
				 <span v-text="news.body.substr(0, 50)"></span>
				 <span v-show="showElipsis">...</span>
				 <abbr v-show="showElipsis" class="is-size-6">More</abbr>
			</div>
			<div class="column is-2">
				 <span v-text="dateFromNow(news.created_at)"></span>
			</div>
		</div>
		<table>
			<tr v-for>
				<td></td>
			</tr>
		</table>
	</section>
</template>

<script>
	import moment from 'moment';
export default {
	props: ['news'],

	data () {
		return {
			type: ''
		}
	},

	methods: {
		dateFromNow(date) {
	      return moment(date).fromNow();
	    },
	},

	computed: {
		showElipsis() {
			return this.news.body.length > 50;
		}
	}
}
</script>