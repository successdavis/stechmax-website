<template>

<div class="overlay background">
		<div class="overlay"></div>
		<div class="row">
			<div class="columns overlay__content reg-form" style="max-width: 750px;">
				<div class="column is-8 text-align-left mt-3">
					<div class="grid-container">
						<!-- ============ -->
						<h3 class="pageTitle">You're almost there...</h3>

						<!-- Display If the user has an email addres and its not yet confirmed -->
						<div v-if="user.email && user.confirmed === false">
					        <p>Please click on the link sent to your email address to confirm your account</p>
					        <p class="center-text">Haven't received the confirmation email yet?</p> 
					        <button class="button" @click="resendConfirmLink">Resend Email</button>
				        </div>

						<!-- Display If the user has a phone and its not yet confirmed -->
				        <div v-if="user.phone && user.phone_confirmed === false">
				        	<form @keyup.prevent="verifyToken">
				        		<p>Please provide token sent to <span v-text="user.phone"></span></p>
				        		<input class="input" type="text" v-model="token" maxlength="6">
				        	</form>
				        	<span class="center-text white"><a @click.prevent="resendToken" style="color: white">Resend Token</a></span>            
				        </div>
					</div>
				</div>
				<div class="column is-4 white mt-3">
					<div class="mb-3">
						<a href=""><img :src="logo" alt="Stechmax Logo"></a>
						<p class="center-text">One Account for all Services</p>
					</div>

					<p>Phone validation is only for Nigerians only, for non-Nigerians please register using email</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user'],
		data () {
			return {
				email: this.user.email,
				token: '',
				logo: '',
				submitting: '',
				errorMessage: '',
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
			resendConfirmLink() {
				axios.post('/register/resend')
				.then (
					flash('Confirmation Link Resent')
				)
			},

			verifyToken() {
				if (this.token.length === 6) {
					var numbers = /^[0-9]+$/;
					if(!this.token.match(numbers)){
						flash('Please input numeric characters only', 'failed');
						return false;
					}

					axios.post('/register/verifytoken', { token: this.token})
					.then (data => {
						flash('Token Verification Successful')
						window.location.href = "/courses";
					})
					.catch(error => {
						this.errorMessage = error.message;
						flash('You have submitted an invalid token', 'failed');
						this.submitting = false
					})
				}
			},

			resendToken () {
				axios.post('/register/resendverifytoken')
					.then (data => {
						flash('A new token has been sent to your phone')
					})
					.catch(error => {
						this.errorMessage = error.message;
						flash('Error! Please wait for five minutes before resending code', 'failed');
						this.submitting = false
					})
			}

		}
	}
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
</style>