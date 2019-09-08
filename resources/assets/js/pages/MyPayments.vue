<template>
	<div class="grid-container">
		<h3>My Payments History</h3>
		<ul class="vertical menu accordion-menu" data-accordion-menu>
		  <li v-for="(invoice, index) in Payments" :key="invoice.id">
		    <a href="#" class="flex-container"><i class="fas fa-file-invoice"></i>
		    	<ul class="paymentsheader flex-container">
		    		<li v-text="invoice.date"></li>
		    		<li v-text="'Invoice No: ' + invoice.invoiceNo"></li>
		    		<li v-text="'Status: ' + invoice.status"></li>
		    	</ul>
		    </a>
		    <ul class="menu vertical nested">
		    <table class="stack">
		      <thead>
		        <tr>
		          	<th>Date</th>
					<th>Transaction</th>
					<th>Purpose</th>
					<th>Amount Paid</th>
		        	</tr>
		      </thead>
		      <tbody>
		        <tr v-for="payment in invoice.payments">
		          <td v-text="payment.created_at"></td>
		          <td v-text="payment.transaction_ref"></td>
		          <td v-text="payment.purpose"></td>
		          <td v-text="payment.amount"></td>
		        </tr>
		      </tbody>
		    </table>
		    </ul>
		  </li>
		</ul>
	
	</div>
</template>

<script>
	export default {
		props: ['user'],
		data () {
			return {
				Payments: [],
			}
		},

		created () {
			axios.get(`/dashboard/${this.user.username}/getuserpayments`)
				.then(response => {
					this.Payments = response.data.data
				}
			);
		}
	}
</script>
<style scoped>
	.flex-container {
		display: flex;	
	}
	.paymentsheader {
		font-weight: bolder;
		flex-grow: 1;
	}

	ul li {
	    list-style: none;
	}


</style>