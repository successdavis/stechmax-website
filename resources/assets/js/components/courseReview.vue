<template>
	<div class="section">
		<form @submit.prevent="addReview" @keydown="postForm.errors.clear()" @keydown.enter.prevent="createSection">
			<div class="field">
			  <div class="control">
			    <textarea v-model="postForm.testimonial" class="textarea is-primary" placeholder="Keep your review brief"></textarea>
			  </div>
			  <p class="help is-danger" v-if="postForm.errors.has('testimonial')" v-text="postForm.errors.get('testimonial')" id="testimonial"></p>
			</div>
			<button type="submit" 
				:class="processing ? 'is-loading' : '' " 
				class="button is-info is-rounded">Submit Review</button>
		</form>
	</div>
</template>

<script>
	export default {
		props: ['course'],

		data () {
			return {
				processing: false,
				postForm: new Form({
					testimonial: ''
				}),
			}
		},

		created() {
			axios.get('/testimonials').then(data => {
				console.log(data);
			});
		},

		methods: {
			addReview() {
				this.processing = true;
				this.postForm.post(`/testimonial/${this.course.slug}`)
				.then(data => {
					this.processing = false;
					flash('Your review was added successfully');
				})
				.catch(error => {
					this.processing = false;
					flash('There was an error submitting your review', 'failed');
				})
			}
		}
	}
</script>