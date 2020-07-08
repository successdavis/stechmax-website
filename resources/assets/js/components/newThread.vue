<template>
	<div>
		<a @click="$modal.show('new-thread')" class="button mb-3">POST A QUESTION</a>
		<modal 
			name="new-thread" 
			:pivotY="1"
			height="auto"

			:adaptive="true"
			scrollable="scrollable"

			>
			<div >
				<form @submit.prevent="generateRecaptcha" @keydown="threadform.errors.clear()">
					<nav class="panel">
					  <p class="panel-heading">
					    NEW THREAD
					  </p>
					  <div class="panel-block">
					    <article style="width: 100%" class="media">
						  <div class="media-content">
						    <div class="content is-fullwidth">
						      	<div class="field">
								  <div class="control">
								    <input v-model="threadform.title" class="is-static is-medium input" type="text" placeholder="Add a Title Here">
								  </div>
								</div>
						    </div>
						  </div>
						  <div class="media-right">
						    <div class="select is-rounded is-static">
							  <select v-model="threadform.channel_id" class="is-static">
							    <option value="">Channel</option>
							    <option v-for="channel in channels" :value="channel.id" v-text="channel.name"></option>
							  </select>
							</div>
						  </div>
						</article>
					  </div>
					  <div class="panel-block">
						  <textarea v-model="threadform.body" class="rm-txt-area-border textarea" placeholder="What's on your mind." rows="8"></textarea>
					  </div>
					  <div class="panel-block">
					    <!-- Main container -->
						<nav class="level" style="width: 100%">
						  <!-- Left side -->
						  <div class="level-left">
						    <div class="level-item">
						      <p class="subtitle is-5">
						        <strong>Please Note:</strong> Do not include spam words.
						      </p>
						    </div>
						  </div>

						  <!-- Right side -->
						  <div class="level-right">
						    <p class="level-item"><a class="button is-success" @click="$modal.hide('new-thread')">Cancel</a></p>
						    <button  class="level-item"><a :class="submitting ? 'is-loading' : '' " class="button is-success">Post</a></button>
						  </div>
						</nav>
					  </div>
					</nav>
				</form>
			</div>
		</modal>
	</div>
</template>

<script>
export default {
	props: ['channels'],
	data () {
		return {
			submitting: false,
			errorMessage: '',
			threadform: new Form({
				title: '',
				channel_id: '',
				body: '',
				token: '',
			})
		}
	},

	methods: {
		postThreadForm () {
			this.submitting = true;
			this.threadform.post('/threads')
			.then(data => {
				flash("Your new thread has been posted")
				this.$modal.show('new-thread');
				window.location.href = data;
			})
			.catch(error => {
				this.errorMessage = error.message;
				flash('Your form contain errors', 'failed')
				this.submitting = false;
			})
		},
		generateRecaptcha() {
			grecaptcha.ready(() => {
		      	grecaptcha.execute('6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM', {action: 'homepage'})
		      	.then((token) => {
		      		this.threadform.token = token;
		      		this.postThreadForm();
		      	});
			});
		},
	}
}

</script>