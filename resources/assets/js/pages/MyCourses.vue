<template>
	<div class="grid-container">
		<h3>My Subscription History</h3>
		<table class="mt-3">
			<thead>
				<th>Status</th>
				<th>Title</th>
				<th>Subscribed On</th>
				<th>Subscription Ends at</th>
			</thead>
			<tr v-for="data in courses">
				<td v-text=""></td>
				<td v-text="data.title"></td>
			</tr>
		</table>
	</div>
</template>

<script>
	export default {
		props: ['user'],
		data () {
			return {
				courses: {}
			}
		},

		created () {
			axios.get(`/dashboard/${this.user.username}/getusercourses`)
				.then(response => {
					this.courses = response.data.data
				}
			);
		}
	}
</script>