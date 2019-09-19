<template>
	<div class="has-overlay background">
		<div class="overlay"></div>
		<div class="row overlay__content">
			<div class="grid-x grid-container reg-form" style="max-width: 850px;">
				<div class="medium-8 text-align-left mt-3">
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
						      <button type="submit" class="medium button">Submit</button>
						      <span style="color: white">Already have an account? </span><a href="/login" class="login_link"> Login</a>
					      </div>
					    </div>
					  </div>
					</form>
				</div>
				<div class="medium-4 white mt-3 reg-form-paragraph">
					<div class="mb-3">
						<a href="/"><img :src="logo" alt="Stechmax Logo"></a>
						<p class="center-text">One Account for all Services</p>
					</div>
					<div class="grid-x grid-container grid-padding-x">
						<div class="small-6 medium-6">
							<a href=""><i class="fas fa-book-open"></i></a>
							<p class="center-text">Projects</p>
						</div>
						<div class="small-6 medium-6">
							<a href=""><i class="fas fa-store"></i></a>
							<p class="center-text">E-Store</p>
						</div>
						<div class="small-6 medium-6">
							<a href="/threads"><i class="far fa-comments"></i></a>
							<p class="center-text">Forum</p>
						</div>
						<div class="small-6 medium-6">
							<a href=""><i class="fas fa-copy"></i></a>
							<p class="center-text">Templates</p>
						</div>
						<div class="small-6 medium-6">
							<a href=""><i class="fas fa-school"></i></a>
							<p class="center-text">School</p>
						</div>
					</div>
					<p>Registration with phone is only for Nigerians, for non-Nigerians please use email</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				errorMessage: '',
				submitting: '',
				logo:'',
				templatelogo:'',
				template:'',
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

		created () {
			axios.get('/settings/getSiteLogo')
				.then(response => {
					this.logo = response.data;
				}
			);
		},

		methods: {
			submitForm () {
				this.$Progress.start()
				this.RegForm.post('/register')
				.then(data => {
					flash("Registration Successful")
					this.$Progress.finish()
					window.location.href = "/register/comfirm_email";
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
			      		this.RegForm.token = token;
			      		this.submitForm();
			      	});
				});
			},
		}
	};

</script>

<style scoped>
	.text-align-left {
		text-align: left;
	}

	label, .white, p {
		color: white;
	}

	.reg-form {
		background: #222a38;
		-webkit-box-shadow: 0px 3px 13px 3px rgba(42,40,66,0.78);
		-moz-box-shadow: 0px 3px 13px 3px rgba(42,40,66,0.78);
		box-shadow: 0px 3px 13px 3px rgba(42,40,66,0.78);
	}

	.background {
		background-image: url(/../images/background_2.jpg);
		background-size: cover;
	    background-position: center;
	    background-repeat: no-repeat; 
	}

	.help-text {
		color: red;
	}

	i {
		color: antiquewhite;
		font-size: 1.7em;
	}

	.logo {
	    width: 2.2em;
	}

	.pageTitle {
		width: 100%;
	    text-align: center;
	    color: antiquewhite;
	}
	a:hover {
		border-bottom: none;
		
	}

	.login_link {
		color: white;
	}
	.login_link:hover {
		color: red;
	}
	.has-overlay {
		position: absolute;
		top: 0;
		width: 100%;
		height: 100vh;
	}
	@media (max-width: 640px) {
		.reg-form-paragraph {
			order: -1;
		}

		.has-overlay {
			height: unset;
			position: unset;
		}

		.overlay__content {
			position: relative;
			-webkit-transform: unset;
			-moz-transform: unset;
			transform: unset;
			left: unset;
			padding: unset;
		}

		.overlay {
			display: none;
		}
		.has-overlay:hover .overlay__content{
		top: unset;
		left: unset;
	}
	}
</style>
