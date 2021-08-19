<template>
	<div>
		<section>
			<form @submit.prevent="checkValueAndFindInvoice">
				<label> Enter Invoice No./Student ID
					<div class="columns">
						<div class="column auto">
							<input v-model="idno" class="input" type="text" placeholder="Enter Invoice Number or Student ID">
						</div>
						<div class="column is-2">
							<button :class="isLoading ? 'is-loading' : '' " class="button is-fullwidth is-primary">Find</button>
						</div>
					</div>
				</label>
			</form>
	    </section>
	    <section v-if="user" class="bg-white mt-3" style="padding: 1em">
	    	<div class="columns">
	    		<center class="column is-3">
	    			<figure class="image is-128x128">
					  <img class="is-rounded" :src="user.passport_path">
					</figure>
	    		</center>
	    		<div class="column is-9">
	    			<h2 class="title" v-text="user.f_name + ' ' + user.m_name"></h2>
	    			<table>
	    				<tr>
	    					<th>ID No. :</th>
	    					<td v-text="user.user_id"></td>
	    				</tr>
	    			</table>
	    		</div>
	    	</div>
	    	<div>
	    		<table class="table is-fullwidth">
	    			<tr v-for="userinvoice in user.invoices">
	    				<td >
	    					<span v-show="invoice.id === userinvoice.id">**</span>
	    				</td>
	    				<td>{{userinvoice.invoiceNo}}</td>
	    				<td>{{userinvoice.date}}</td>
	    				<td>{{userinvoice.amount}}</td>
	    				<td>{{userinvoice.status}}</td>
	    				<td><button class="button is-success" @click="selectInvoice(userinvoice)">Select</button></td>
	    			</tr>
	    		</table>
	    		
	    	</div>
	    </section>
	    <section v-if="invoice">
	    	<div class="columns mt-3">
				<h5 class="column is-6" v-text=" 'Date: ' + invoice.date "></h5>
				<div class="column is-4"><strong>Invoice Amount: </strong>	&#8358;<p v-text="invoice.amount"></p></div>
				<div class="column is-4"><strong>Amount Owed: </strong> 	&#8358;<p v-text="invoice.status"></p></div>
			</div>
	    </section>
	    <section v-if="canAddPayment" class="mt-3">
	    	<div class="columns is-multiline">
	    		<div class="column is-5">
		    		<div class="field">
				    	<label class="label">Amount to Pay?</label>
				    	<div class="control">
							<input class="input" type="number" min="0" name="amount" v-model="Form.amount">
						</div>
					</div>
		      	</div>
	    		<div class="column is-5">
		    		<div class="field">	
			        	<label class="label">Purpose of Payment?</label>
			        	<div class="control">
				        	<div class="select is-fullwidth">
							  	<select v-model="Form.purpose" required>
							  		<option selected value="">Click to select</option>
							    	<option 
							    	v-for="purpose in Purpose" :value="purpose" 
							    	v-text="purpose"></option>
							  	</select>
						  	</div>
					  	</div>
		    		</div>
		      	</div>
	    		<div class="column is-5">
		    		<div class="field">	
			        	<label class="label">Method of Payment?</label>
			        	<div class="control">
				        	<div class="select is-fullwidth">
							  	<select v-model="Form.method" required>
							  		<option selected value="">Click to select</option>
							    	<option>CASH</option>
							    	<option>TRANSFER</option>
							    	<option>DEPOSIT</option>
							  	</select>
						  	</div>
					  	</div>
		    		</div>
		      	</div>
		      	<div class="column is-2">
		      		<label>.</label>
		      		<button @click.prevent="proccessPayment" class="medium button is-fullwidth is-primary" :disabled="isLoading">Add Payment</button>
		      	</div>
	    	</div>
	    </section>
	    <section v-if="invoice" class="mt-3" id="test">
	    	<h2 class="title">Invoice Payments</h2>
			<table class="table is-fullwidth">
		      <thead>
		        <tr>
		          	<th>Date</th>
					<th>Transaction</th>
					<th>Purpose</th>
					<th>Amount Paid</th>
					<th>Action</th>
		        </tr>
		      </thead>
		      <tbody>
		        <tr v-for="(payment, index) in invoice.payments" :style="!payment.refundable ? 'background: #f3a9a9;' : '' ">
		          	<td v-text="payment.date"></td>
		          	<td v-text="payment.ref"></td>
		          	<td v-text="payment.purpose"></td>
		          	<td v-text="payment.amount"></td>
		          	<td v-if="payment.refundable"><button :class="isLoading ? 'is-loading' : '' " class="button is-danger" @click="refundPayment(payment.id)">Refund Bill</button></td>
		          	<td><a @click.prevent="printReciept(payment.id)" title="Print Reciept" :class="isLoading ? 'is-loading' : '' " class="button is-success">PR</a></td>
		        </tr>
		      </tbody>
		    </table>
	    </section>
	</div>
</template>

<script>
import print from 'print-js'

	export default {
		data () {
			return {
				idno: 'STM-2021-0003',
				invoice: '',
				user: '',
				Form: new Form({
					invoice: '',
					purpose: '',
					amount: '',
					method: '',
				}),
				errorMessage: "",
				isLoading: false,
				Purpose: [
					'Invoice Fee',
					'Discount',
				],
			}
		},

		created() {
			if (localStorage.getItem('invoiceNo') !== null) {
				this.idno = localStorage.getItem('invoiceNo');
				this.findInvoice();
				localStorage.removeItem('invoiceNo');
			}
		},

		computed: {
			canAddPayment() {
				if (!this.invoice || this.invoice.completed) {
					return false;
				}else {
					return true;
				}
			}
		},

        methods: {
        	selectInvoice (invoice) {
        		this.Form.invoice = invoice.id
        		this.invoice = invoice
        	},
        	checkValueAndFindInvoice() {
        		console.log();
        		if (this.idno.search(/[-]/g) !== -1) {
        			this.findInvoice();
        		}else{
        			this.invoice = '';
        			this.findUser();
        		}
        	},
        	findUser() {
        		this.isLoading = true;
        		axios.get('/finduserwithinvoices', {
        		  params: {
        		    user_id: this.idno,
        		  },
        		}).then((response) => {
	        		this.isLoading = false;
        		   	this.user = response.data.data;
        		}).catch((error) => {
	        		this.isLoading = false;
        		  	flash('Sorry Unable to retrieve User','failed');
        		})
        	},
        	findInvoice() {
	        		this.isLoading = true;
        		axios.get(`/findinvoice/${this.idno}`).then((response) => {
        			this.isLoading = false;
        		  	this.invoice = response.data.data;
        		  	this.user = response.data.data.billedTo;
        		  	this.Form.invoice = response.data.data.id
        		}).catch((error) => {
        			this.isLoading = false;
        		  	flash('Unable to retrieve invoice','failed');
        		})
        	},
        	setFormInvoice() {
        		this.Form.invoice = this.selected.id;
        		this.RefundForm.invoice = this.selected.id;
        	},

        	proccessPayment() {
        		this.isLoading = true
        		this.Form.post('/dashboard/payments/addpayment')
                    .then(data => {
                        this.invoice = data.data;
                        flash('Payment Made Successfully');
                    	this.isLoading = false;
                    })
                .catch(error => {
                	this.errorMessage = error.message;
                    flash('We were unable to process your form','failed')
                    this.isLoading = false;
                });
        	},

        	refundPayment(paymentid) {
        		this.isLoading = true;
        		axios.post('/dashboard/payments/refundpayment', {
        		  paymentId: paymentid,
        		  invoice: this.invoice.id
        		}).then((response) => {
        			this.invoice = response.data.data
        		  	flash('Payment Successfully Refunded');
                    this.isLoading = false;
        		}).catch((error) => {
        		    flash('We were unable to process your form', 'failed')
                	this.errorMessage = error.message;
                    this.isLoading = false;
        		})
        	},

        	printReciept(payment) {

	        		printJS(`/payment-receipt/${payment}`);
        	}
        }
	};
</script>

<style scoped>
	.errorMessage {
	    text-align: center;
	    color: white;
	    padding: 1em;
	    background: red;
	}
</style>