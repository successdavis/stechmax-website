<template>
	<div class="card has-table has-mobile-sort-spaced">
		<div class="card-content">
			<h3 class="title">My Payments History</h3>
			<ul class="vertical menu accordion-menu" data-accordion-menu>
			  <li v-for="(invoice, index) in Invoices" :key="invoice.id">
			    <a href="#" class="flex-container"><i class="fas fa-file-invoice"></i>
			    	<ul class="paymentsheader flex-container">
			    		<li v-text="invoice.date"></li>
			    		<li v-text="'Invoice No: ' + invoice.invoiceNo"></li>
			    		<li v-text="'Status: ' + invoice.status"></li>
			    	</ul>
			    </a>
			    <ul class="menu vertical nested">
				    <div class="b-table">
						<div class="table-wrapper">
						    <table class="table is-striped has-mobile-cards is-hoverable">
						      <thead>
						        <tr>
						          	<th>Date</th>
									<th>Transaction Ref.</th>
									<th>Purpose</th>
									<th>Amount Paid</th>
									<th>Status</th>
						        	</tr>
						      </thead>
						      <tbody>
						        <tr v-for="payment in invoice.payments">
						          <td v-text="payment.date"></td>
						          <td v-text="payment.ref"></td>
						          <td v-text="payment.purpose"></td>
						          <td v-text="payment.amount"></td>
						          <td v-text="payment.status"></td>
						        </tr>
						      </tbody>
						    </table>
						</div>
					</div>
			    </ul>
			  </li>
			</ul>				
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user'],
		data () {
			return {
				Invoices: [],
			}
		},

		created () {
			axios.get(`/dashboard/${this.user.username}/getuserpayments`)
				.then(response => {
					this.Invoices = response.data.data
				}
			);
		}
	};
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