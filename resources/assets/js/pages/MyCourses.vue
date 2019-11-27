<template>
	<div class="grid-container">
		<h3>My Subscription History</h3>
		<table class="mt-3">
			<thead>
				<th>Active</th>
				<th>Title</th>
				<th>Subscribed On</th>
				<th>Subscription Ends at</th>
			</thead>
			<tbody>
				<tr v-for="data in courses">
					<td v-text="data.status"></td>
					<td><a :href="data.path" v-text="data.course.title"></a></td>
					<td v-text="data.subscribedOn"></td>
					<td v-text="data.subscribtionEndAt"></td> 
				</tr>
			</tbody>
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