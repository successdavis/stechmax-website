<template>
	<div class="grid-container">
		<form @submit.prevent="proccessPayment" @change="errorMessage=''" >
			<!-- To display Error Message -->
			<p v-if="errorMessage" class="errorMessage" v-text="errorMessage"></p>

		  <div class="grid-container">
		    <div class="grid-x grid-padding-x" >
		      <div class="cell">
		        <label>Select an Invoice?
				  <select v-model="selected" required @change="setFormInvoice">
				  	<option selected value="">Click to select an Invoice</option>
				    <option v-for="invoice in Data.invoices" :value="invoice" v-text="invoice.invoiceNo + ' == ' + invoice.billedTo.f_name + ' ' + invoice.billedTo.l_name">
				    </option>
				  </select>
				</label>
		      </div>
		      <div class="cell medium-6">
		        <label>Purpose of Payment?
				  <select v-model="Form.purpose" required>
				  	<option selected value="">Click to select</option>
				    <option v-for="purpose in Data.Purpose" :value="purpose" v-text="purpose"></option>
				  </select>
				</label>
		      </div>
		      <div class="cell medium-6" v-if="Form.purpose != 'Refund'">
		        <label>Whats the Amount?
				  <input type="number" min="0" name="amount" v-model="Form.amount">
				</label>
		      </div>
		       <div class="cell medium-6" v-if="Form.purpose == 'Refund'">
		        <label>Select Payment to refund?
				  <select v-model="RefundForm.paymentId" required>
				  	<option selected value="">Click to select a payment to refund</option>
				    <option v-for="payment in selected.payments" :value="payment.id" v-text="payment.transaction_ref"></option>
				  </select>
				</label>
		      </div>

		    </div>
		    <button class="medium button" :disabled="submitting">Add Payment</button>
		  </div>
		</form>
		<div class="grid-container mt-3" v-if="selected">
			<div class="grid-x grid-padding-x">
				<h5 class="cell medium-6" v-text=" 'Date: ' + selected.date "></h5>
				<h4 class="cell medium-6" v-text=" 'Billed To: ' + selected.billedTo.f_name + ' ' + selected.billedTo.l_name "></h4>
				<h4 class="cell" v-text=" 'Billed For: ' + selected.billable.title"></h4>
				<div class="cell medium-4"><strong>InvoiceNo: </strong> <p v-text="selected.invoiceNo"></p></div>
				<div class="cell medium-4"><strong>Invoice Amount: </strong><p v-text="selected.amount"></p></div>
				<div class="cell medium-4"><strong>Amount Owed: </strong><p v-text="selected.status"></p></div>
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
			        <tr v-for="payment in selected.payments">
			          <td v-text="payment.created_at"></td>
			          <td v-text="payment.transaction_ref"></td>
			          <td v-text="payment.purpose"></td>
			          <td v-text="payment.amount / 100"></td>
			        </tr>
			      </tbody>
			    </table>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				Form: new Form({
					invoice: '',
					purpose: '',
					amount: '',
				}),
				RefundForm: new Form({
					invoice: '',
					paymentId: '',
				}),
				errorMessage: "",
				selected: "",
				submitting: false,
				Data: {
					invoices: {},
					Purpose: [
						'Fees',
						'Discount',
						'Refund'
					],
				}
			}
		},

		created () {
            axios.get('/api/invoices/getallinvoices')
                .then(response => this.Data.invoices = response.data.data);
        },

        methods: {
        	setFormInvoice() {
        		this.Form.invoice = this.selected.id;
        		this.RefundForm.invoice = this.selected.id;
        	},

        	proccessPayment() {
        		if (this.Form.purpose != 'Refund') {
	        		this.submitting = true
	        		this.Form.post('/dashboard/payments/addpayment')
	                    .then(data => {
	                        // this.Form.reset();
	                        flash('Payment Added Successfully');
	                    	this.submitting = false;
	                    	location.reload();
	                    })
	                .catch(error => {
	                	this.errorMessage = error.message;
	                    flash('We were unable to process your form')
	                    this.submitting = false;
	                });
        		}else {
        			this.submitting = true
	        		this.RefundForm.post('/dashboard/payments/refundpayment')
	                    .then(data => {
	                        // this.Form.reset();
	                        flash('Payment Successfully Refunded');
	                    	this.submitting = false;
	                    	location.reload();
	                    })
	                .catch(error => {
	                	this.errorMessage = error.message;
	                    flash('We were unable to process your form')
	                    this.submitting = false;
	                });
        		}
        	}
        }
	}
</script>

<style scoped>
	.errorMessage {
	    text-align: center;
	    color: white;
	    padding: 1em;
	    background: red;

	}
</style>