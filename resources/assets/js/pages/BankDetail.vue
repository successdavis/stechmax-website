<template>
	<div>
		<div></div>
		<form @submit.prevent="submit">
			<div class="field">
			  <label class="label">Bank Name</label>
			  <div class="control">
			    <input v-model="Bankform.bank_name" class="input" type="text" placeholder="Text input">
			  </div>
              <p class="help-text" id="courseTitleHelpText" v-if="Bankform.errors.has('bank_name')" v-text="Bankform.errors.get('bank_name')"></p>
			</div>
			<div class="field">
			  <label class="label">Name on Bank Account</label>
			  <div class="control">
			    <input v-model="Bankform.account_name" class="input" type="text" placeholder="Text input">
			  </div>
              <p class="help-text" id="courseTitleHelpText" v-if="Bankform.errors.has('account_name')" v-text="Bankform.errors.get('account_name')"></p>
			</div>
			<div class="field">
			  <label class="label">Account Number</label>
			  <div class="control">
			    <input v-model="Bankform.account_number" class="input" type="text" placeholder="Text input">
			  </div>
              <p class="help-text" id="courseTitleHelpText" v-if="Bankform.errors.has('account_number')" v-text="Bankform.errors.get('account_number')"></p>
			</div>
			<div class="field">
			  <label class="label">Account Type</label>
			  <div class="control">
			    <input v-model="Bankform.account_type" class="input" type="text" placeholder="Text input">
			  </div>
              <p class="help-text" id="courseTitleHelpText" v-if="Bankform.errors.has('account_type')" v-text="Bankform.errors.get('account_type')"></p>
			</div>

			  <button type="submit" class="button is-success is-medium">SUBMIT</button>
		</form>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				submitting: false,
				Bankform: new Form ({
					bank_name: '',
					account_name: '',
					account_number: '',
					account_type: '',
				}),
			}
		},

		computed: {
			user() {
				return window.App.user;
			}
		},

		created() {
			axios.get(`employeebankdetails/${this.user.username}`).then((response) => {
			  this.Bankform.bank_name = response.data.bank_name;
			  this.Bankform.account_name = response.data.account_name;
			  this.Bankform.account_number = response.data.account_number;
			  this.Bankform.account_type = response.data.account_type;
			}).catch((error) => {
			  flash('something went wrong with fetching bank details');
			})
		},

		methods: {
			submit() {
				this.submitting = true;
				this.Bankform.post('savebankdetails').then(data => {
					flash('Account Details added');
					this.submitting =  false;
				}).catch(error => {
					flash('error submitting account details','failed')
					this.submitting = false;
				})
			}
		}
	};
</script>