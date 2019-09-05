<template>
	<div class="grid-container">
		<h3>My Payments History</h3>
		<table class="mt-3">
			<thead>
				<th>Date</th>
				<th>Transaction</th>
				<th>Invoice</th>
				<th>Amount</th>
				<th>Amount Owe</th>
			</thead>
			<tbody>
				<tr v-for="data in payments">
					<td v-text="data.date"></td>
					<td v-text="data.transaction"></td>
					<td v-text="data.invoice"></td>
					<td v-text="data.amount"></td> 
					<td v-text="data.amount_owe"></td> 
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
				payments: {}
			}
		},

		created () {
			axios.get(`/dashboard/${this.user.username}/getuserpayments`)
				.then(response => {
					this.courses = response.data.data
				}
			);
		}
	}
</script>