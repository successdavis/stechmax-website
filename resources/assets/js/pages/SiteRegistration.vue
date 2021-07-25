<template>
	<div class="mt-2">
		<div class="register_section" v-if="interfaceMode == 'register'">
			<form @submit.prevent="generateRecaptcha" @keydown="RegForm.errors.clear()">
			    <h3 class="has-text-centered is-size-4 mb-2">Create an Account</h3>
			    <div class="columns is-multiline">
					<div class="field column is-12">
						<label class="label">Email</label>
						<div class="control">
						  <input class="input" type="text" placeholder="Required" v-model="RegForm.email" required>
						  <p class="help" v-if="RegForm.errors.has('email')" v-text="RegForm.errors.get('email')"></p>
						  <p class="help" v-if="!RegForm.errors.has('email')">NB: Support for Phone registration system has been removed</p>
						</div>
					</div>
					<div class="field column is-4">
						<label class="label">Surname</label>
						  <input class="input" type="text" placeholder="Required" v-model="RegForm.surname" required>
						  <p class="help" v-if="RegForm.errors.has('surname')" v-text="RegForm.errors.get('surname')"></p>
					</div>
					<div class="field column is-4">
						<label class="label">Last Name</label>
						  <input class="input" type="text" placeholder="Required" v-model="RegForm.lastname" required>
						  <p class="help" v-if="RegForm.errors.has('lastname')" v-text="RegForm.errors.get('lastname')"></p>
					</div>
					<div class="field column is-4">
						<label class="label">Other Names</label>
						  <input name="lastname" class="input" type="text" placeholder="Optional" v-model="RegForm.middlename">
						  <p class="help" v-if="RegForm.errors.has('middlename')" v-text="RegForm.errors.get('middlename')"></p>

					</div>
					<div class="field column is-6">
						<label class="label">Gender</label>
						<div class="control">
							<div class="select is-fullwidth">
							  <select v-model="RegForm.gender" required>
							  	<option selected value="" disabled>Click to pick</option>
							    <option value="M">Male</option>
							    <option value="F">Female</option>
							  </select>
							  <p class="help" v-if="RegForm.errors.has('gender')" v-text="RegForm.errors.get('gender')"></p>
							</div>
						</div>
					</div>
					<div class="field column is-6">
						<label class="label">Date of Birth</label>
						<div class="control">
						  <input class="input" type="date" placeholder="Required" v-model="RegForm.dateofbirth" required>
						  <p class="help" v-if="RegForm.errors.has('dateofbirth')" v-text="RegForm.errors.get('dateofbirth')"></p>
						</div>
					</div>
					<div class="field column is-6">
						<label class="label">Password</label>
						<div class="control">
							<b-field>
					            <b-input type="password"
					            	v-model="RegForm.password"
					                placeholder="Required"
					                password-reveal>
					            </b-input>
					        </b-field>
						  	<p class="help" v-if="RegForm.errors.has('password')" v-text="RegForm.errors.get('password')"></p>
						</div>

					</div>
					<div class="field column is-6">
						<label class="label">Confirm Password</label>
						<div class="control">
							<b-field>
					            <b-input type="password"
					            	v-model="RegForm.password_confirmation"
					                placeholder="Retype password"
					                password-reveal>
					            </b-input>
					        </b-field>
						  <p class="help-text" v-if="RegForm.errors.has('password_confirmation')" v-text="RegForm.errors.get('password_confirmation')"></p>
						</div>

					</div>
				</div>
				<div class="">
				  <button :disabled="submitting == true" type="submit" :class="submitting ? 'is-loading' : '' " class="button is-success is-outlined is-medium is-fullwidth">Submit</button> <br>
				  <span>Already have an account? </span><a class="login_link" @click="interfaceMode = 'login'"> Login</a>
				</div>
			</form>
		</div>
		<div class="login_section" v-if="interfaceMode == 'login'">
            <div class="container has-text-centered">
                <div class="column is-offset-4">
                    <h3 class="title has-text-black">Login</h3>
                    <hr class="login-hr">
                    <p class="subtitle has-text-black">Please login to proceed.</p>
                    <div class="box">
                        <!-- <figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure> -->
                        <form @submit.prevent="loginForm" @keydown="LogForm.errors.clear()">
                            <div class="field">
                                <div class="control">
                                    <input v-model="LogForm.email" class="input is-large" type="text" placeholder="Your Email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input v-model="LogForm.password" class="input is-large" type="password" placeholder="Your Password">
                                </div>
                            </div>
                            <div class="field">
                                <label class="checkbox">
                  <input type="checkbox">
                  Remember me
                </label>
                            </div>
                            <button :class="submitting ? 'is-loading' : '' " class="button is-block is-info is-large is-fullwidth">Login
                            	<i class="fa fa-sign-in" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                    <p class="has-text-grey has-text-centered">
                        <a @click="interfaceMode = 'register'">Sign Up</a> &nbsp;·&nbsp;
                        <a href="/password/reset">Forgot Password</a> &nbsp;·&nbsp;
                        <a href="/threads">Need Help?</a>
                    </p>
                </div>
            </div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['loginroute', 'registerroute', 'mode'],
		data () {
			return {
				interfaceMode: this.mode,
				errorMessage: '',
				submitting: '',
				logo:'',
				templatelogo:'',
				template:'',
				RegForm: new Form ({
					email:'',
					surname:'',
					lastname:'',
					middlename: '',
					gender:'',
					dateofbirth:'',
					password:'',
					password_confirmation:'',
					// token:'',
				}),
				LogForm: new Form ({
					email: '',
					password: ''
				}),
			}
		},

		methods: {
			submitForm () {
				this.submitting = true;
				this.$Progress.start()
				this.RegForm.post('/register')
				.then(data => {
					flash("Registration Successful")
					this.$Progress.finish()
					window.location.href = this.registerroute ? this.registerroute : "/register/comfirm_email";
				})
				.catch(error => {
					this.errorMessage = error.message;
					flash('Your form contain errors', 'failed')
					this.$Progress.fail()
					this.submitting = false;
				})
			},
			loginForm () {
				this.submitting = true;
				this.$Progress.start()
				this.LogForm.post('/login')
				.then(data => {
					flash("Login Successful")
					this.$Progress.finish()
					if (this.loginroute) {
						window.location.href = this.loginroute;
					}else {
						window.location.href = "/dashboard";
					}
				})
				.catch(error => {
					this.errorMessage = error.message;
					flash('Your form contain errors', 'failed')
					this.$Progress.fail()
					this.submitting = false;
				})
			},

			generateRecaptcha() {

				grecaptcha.ready(() => {
			      	grecaptcha.execute('6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM', {action: 'homepage'})
			      	.then((token) => {
			      		// this.RegForm.token = token;
			      		this.submitForm();
			      	});
				});
			},
		}
	};

</script>

<style scoped>
	field:not(:last-child) {
	     margin-bottom: 0;
	}
</style>
