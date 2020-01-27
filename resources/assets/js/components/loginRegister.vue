<template>
	<div>
		<button @click="$modal.show('quick_login')">Login/Register</button>
		<modal 
			name="quick_login"
			height="auto"
			draggable=".window-header"
			class="scroll"
			:adaptive="true"

		> 
			<div class="grid-container">
				<tabs>
					<div v-model="message" v-text="message"></div>
					<tab name="Login" :selected="true">
						<div>
							<form @submit.prevent="loginUser" @keydown="LogForm.errors.clear()">
						        <label>Email or Phone
						          <input v-model="LogForm.email" type="text" placeholder="Email or Phone">
							      <p class="help-text" v-if="LogForm.errors.has('email')" v-text="LogForm.errors.get('email')"></p>
						        </label>
						        <label>Password
						          <input v-model="LogForm.password" type="text" placeholder="password">
							      <p class="help-text" v-if="LogForm.errors.has('password')" v-text="LogForm.errors.get('password')"></p>
						        </label>
						        <button :disabled="submitting" type="submit" class="button expanded">Login</button>
						      	<div class="medium button" @click="$modal.hide('quick_login')">Cancel</div>
							</form>
						</div>
					</tab>
					<tab name="Register">
							<form @submit.prevent="generateRecaptcha" @keydown="RegForm.errors.clear()">
								<div class="grid-container">
									<div class="grid-x grid-padding-x">
										<h3 class="pageTitle">Create an Account</h3>
									  <div class="cell">
									    <label>Email or Phone
									      <input type="text" placeholder="Required" v-model="RegForm.emailOrPhone" required>
									      <p class="help-text" v-if="RegForm.errors.has('emailOrPhone')" v-text="RegForm.errors.get('emailOrPhone')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Surname
									      <input type="text" placeholder="Required" v-model="RegForm.surname" required>
									      <p class="help-text" v-if="RegForm.errors.has('surname')" v-text="RegForm.errors.get('surname')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Last Name
									      <input type="text" placeholder="Required" v-model="RegForm.lastname" required>
									      <p class="help-text" v-if="RegForm.errors.has('lastname')" v-text="RegForm.errors.get('lastname')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Other Names
									      <input type="text" placeholder="Optional" v-model="RegForm.middlename">
									      <p class="help-text" v-if="RegForm.errors.has('middlename')" v-text="RegForm.errors.get('middlename')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Gender
									      <select v-model="RegForm.gender" required>
									      	<option selected value="" disabled>Click to pick</option>
										    <option value="M">Male</option>
										    <option value="F">Female</option>
										  </select>
									      <p class="help-text" v-if="RegForm.errors.has('gender')" v-text="RegForm.errors.get('gender')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Date of Birth
									      <input type="date" placeholder="Required" v-model="RegForm.dateofbirth" required>
									      <p class="help-text" v-if="RegForm.errors.has('dateofbirth')" v-text="RegForm.errors.get('dateofbirth')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Password
									      <input type="password" placeholder="Required" v-model="RegForm.password" required>
									      <p class="help-text" v-if="RegForm.errors.has('password')" v-text="RegForm.errors.get('password')"></p>
									    </label>
									  </div>
									  <div class="medium-6 cell">
									    <label>Confirm Password
									      <input type="password" placeholder="Re-type password here" v-model="RegForm.password_confirmation" required>
									      <p class="help-text" v-if="RegForm.errors.has('password_confirmation')" v-text="RegForm.errors.get('password_confirmation')"></p>
									    </label>
									  </div>
									  <div class="cell">
									      <div class="medium button" @click="$modal.hide('quick_login')">Cancel</div>
									      <button :disabled="submitting" type="submit" class="medium button">Submit</button>
									  </div>
									</div>
								</div>
								</form>
					</tab>
				</tabs>
			</div>
		</modal>
	</div>
	
</template>

<script>
	export default {
		data () {
			return {
				message: '',
				register: false,
				submitting: false,
				LogForm: new Form({
					email: '',
					password: '',
				}),
				RegForm: new Form ({
					emailOrPhone:'',
					surname:'',
					lastname:'',
					middlename: '',
					gender:'',
					dateofbirth:'',
					password:'',
					password_confirmation:'',
					token:'',
				})
			}
		},

		methods: {
			submitForm () {
				this.RegForm.post('/register')
				this.submitting = true
				.then(data => {
					flash("Registration Successful")
					window.location.href = "/register/comfirm_email";
				})
				.catch(error => {
					this.errorMessage = error.message;
					flash('Your form contain errors', 'failed')
					this.submitting = false;
				})
			},

			loginUser() {
				this.submitting = true
				this.LogForm.post('/login')
				.then(data => {
					// window.location.href = "/register/comfirm_email";
				})
				.catch(error => {
					this.message = error.message;
					this.submitting = false;
					flash('We had a problem signing you in', 'failed')
				})
			},

			generateRecaptcha() {

				grecaptcha.ready(() => {
			      	grecaptcha.execute('6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM', {action: 'homepage'})
			      	.then((token) => {
			      		this.RegForm.token = token;
			      		this.submitForm();
			      	});
				});
			},
		}
	}
</script>

<style scoped> 
	.scroll {
	    overflow: scroll;
	}
</style>