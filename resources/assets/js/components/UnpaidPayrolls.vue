<template>
	<div>
		<div>
			<table class="table">
				<thead>
					<tr>
						<th>Month</th>
						<th>Amount</th>
						<th>Action </th>
					</tr>
					<tr v-for="(payroll, index) in payrolls">
						<td>{{ payroll.created_at | moment }}</td>
						<td v-text="payroll.net_salary"></td>
						<td><button class="button is-success" @click="markAsPaid(payroll, index)">Mark as Paid</button></td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</template>


<script>
import moment from 'moment'
	export default {

		props: ['employee'],

		data () {
			return {
				payrolls: [],
				message: '',
			}
		},

		filters: {
		  moment: function (date) {
		    return moment(date).format('MMMM Do YYYY, h:mm:ss a');
		  }
		},


		created() {
			axios.get(`/unpaidpayroll/${this.employee.user_id}`)
			.then((response) => {
			  this.payrolls = response.data;
			}).catch((error) => {
			  this.message = error
			})
		},

		methods: {
			markAsPaid(payroll, index) {
				axios.post(`/payroll/${payroll.id}/markaspaid`)
				.then((response) => {
					flash('Payroll Cleared')
					this.payrolls.splice(index, 1)
				}).catch(error => {
					console.log(error.message)
				  flash(error, 'failed');
				})
			}
		}

	}

</script>