<template>
	<div class="overlay">
		<div class="row">
			<div class="grid-x grid-container overlay__content reg-form" style="max-width: 850px;">
				<div class="medium-8 text-align-left mt-3">
					<form @submit.prevent="submitForm" @keydown="RegForm.errors.clear()">
					  <div class="grid-container">
					    <div class="grid-x grid-padding-x">
					      <div class="cell">
					        <label>Email or Phone
					          <input type="text" placeholder="Required" v-model="RegForm.emailOrPhone" required>
					          <p class="help-text" v-if="RegForm.errors.has('emailOrPhone')" v-text="RegForm.errors.get('emailOrPhone')"></p>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Surname
					          <input type="text" placeholder="Required" v-model="RegForm.surname" required>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Last Name
					          <input type="text" placeholder="Required" v-model="RegForm.lastname" required>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Other Names
					          <input type="text" placeholder="Optional" v-model="RegForm.middlename">
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Gender
					          <select v-model="RegForm.gender" required>
					          	<option selected value="" disabled>Click to pick</option>
							    <option value="M">Male</option>
							    <option value="F">Female</option>
							  </select>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Date of Birth
					          <input type="date" placeholder="Required" v-model="RegForm.dateofbirth" required>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Password
					          <input type="password" placeholder="Required" v-model="RegForm.password" required>
					        </label>
					      </div>
					      <div class="medium-6 cell">
					        <label>Confirm Password
					          <input type="password" placeholder="Re-type password here" v-model="RegForm.password_confirmation" required>
					        </label>
					      </div>
					      <div class="cell">
						      <button type="submit" class="medium button">Submit</button>
					      </div>
					    </div>
					  </div>
					</form>
				</div>
				<div class="medium-4 white mt-4">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
				RegForm: new Form ({
					emailOrPhone:'hello@gmail.com',
					surname:'success',
					lastname:'daviso',
					middlename: 'feaf',
					gender:'M',
					dateofbirth:'',
					password:'0000000000',
					password_confirmation:'0000000000',
					token:'',
				})
			}
		},

		methods: {
			submitForm () {
				this.RegForm.token = window.App.token;

				this.RegForm.post('/register')
				.then(data => {
					flash("Registration Successful")
					window.location.href = "http://success.test/dashboard";
				})
				.catch(error => {
					this.errorMessage = error.message;
					flash('Your form contain errors')
					this.submitting = false;
				})
			}
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

</style>