<template>
	<div class="section">
		<form v-if="signedIn" @submit.prevent="addReview" @keydown="postForm.errors.clear()" @keydown.enter.prevent="createSection">
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
		<p v-else>Please signin to add a review</p>

		<section class="section">
		  <div class="container has-text-centered">
		    <h2 class="title">Testimonial #1</h2>
		    <div class="columns is-multiline">
		      <div class="column is-4" v-for="(testimonial, index) in testimonials" :key="testimonial.id">
		        <testimonial :testimonial="testimonial" @deleted="remove(index)"></testimonial>
		      </div>
		    </div>
		  </div>
		</section>
	</div>
</template>

<script>
    import testimonial from './testimonial.vue';
	export default {
		props: ['course'],
        components: { testimonial},

		data () {
			return {
				processing: false,
				testimonials: [],
				postForm: new Form({
					testimonial: ''
				}),
			}
		},

		created() {
			axios.get(`/testimonials/${this.course.slug}`).then(data => {
				this.testimonials = data.data.data;
			});
		},

		methods: {
			addReview() {
				this.processing = true;
				this.postForm.post(`/newtestimonial/${this.course.slug}`)
				.then(data => {
					this.processing = false;
					flash('Your review was added successfully');
				})
				.catch(error => {
					this.processing = false;
					flash('There was an error submitting your review', 'failed');
				})
			},

			remove() {
				alert('handling it');
			}
		}
	}
</script>