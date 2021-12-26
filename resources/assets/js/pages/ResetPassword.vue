<template>

<div class="overlay background">
		<div class="overlay"></div>
		<div class="container">
			<div class="section">
				<div class="columns">
					<div class="column is-8 text-align-left mt-3">
						<div class="section">
							<!-- ============ -->
							<h3 class="pageTitle mb-2 has-text-white is-size-4">Password Reset...</h3>
							<form method="POST" @submit.prevent="resetPassword">

				        		<p class="has-text-white">Please provide your email address here</p>

	                            <input class="input" type="email" placeholder="Enter Your Email here" v-model="email" required>

	                            <button :disabled="resetTokenSent" type="submit" :class="submitting ? 'is-loading' : ''" class="button medium" v-text="'Send Reset Link'">
	                            </button>
		                    </form>
						</div>
					</div>
					<div class="column is-4 white mt-3 has-text-black">
						<p class="has-text-white">A reset link will be send to your registered email address</p>
						<p class="has-text-white" v-if="sent == 1">We have sent a reset link to your email, please check your inbox</p>
						<p class="red-text" v-if="sent == 2">You do not have an account with us please <a href="/register" class="button has-text-black">Register</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				email:'',
				phone:'',
				logo: '',
				submitting: '',
				errorMessage: '',
				phoneReset:false,
				resetTokenSent:false,
				sent: 0,
				Form: new Form({
					token: '',
					phone: this.phone,
					password: '',
					password_confirmation: ''
				}),
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
			resetPassword() {

				if (this.phoneReset) {
					this.resetUsingPhone();
				}
				else {
					this.resetUsingEmail();
				}
			},

			resetUsingEmail() {
				this.submitting = true
				axios.post('/password/email', {email: this.email})
				.then(data => {
					flash('Password Reset Link Sent Successfully')
					this.sent = '1';
					this.submitting = false;
				})
				.catch(error => {
					this.errorMessage = error.message;
					flash('This email is not yet registered', 'failed');
					this.submitting = false;
					this.sent = '2';
				})
			},

			resetUsingPhone() {
				if (this.phone.length != 11) {
					flash('Your phone number is not complete', 'failed');
					return false;
				}

				var numbers = /^[0-9]+$/;
				if(!this.phone.match(numbers)){
					flash('Please input numeric characters only', 'failed');
					return false;
				}

				this.submitting = true
				axios.post('/password/phonereset', {phone: this.phone})
				.then(data => {
					flash('A token has been sent to your phone')
					this.resetTokenSent = true;
					this.Form.phone = this.phone;
				})
				.catch(error => {
					this.errorMessage = error.message;
					flash('Sorry! You do not have an account with us', 'failed')
					this.sent = '2';
				})
			},

			updatePassword() {
				this.Form.post('/password/resetUpdatePassword')
				.then(data => {
					flash('Password updated Successfully')
					window.location.href = "/login";
				})
				.catch(error => {
					console.log(error);
					flash('We were unable to update your password', 'failed');
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

	.login_link,
	.white {
		color: white;
	}
	.login_link:hover {
		color: red;
	}
	.red-text {
		color: red;
	}
</style>
