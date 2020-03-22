<template>
	<div class="has-text-centered">
		<div class="level">
          <div class="level-item">
            <figure class="image is-128x128"><img class="is-rounded" :src="testimonial.user.avatar_path" alt=""></figure>
          </div>
        </div>
        <p class="block has-text-centered" v-text="testimonial.testimonial"></p>
        <h5 class="title has-text-centered is-5">Colin</h5>
        <a :href="'/profiles/'+testimonial.user.username" class="subtitle has-text-centered" 
        	v-text="testimonial.user.f_name + ' ' + testimonial.user.m_name "
        ></a>
    </div>
</template>

<script>
	export default {
		props: ['testimonial'],

		data () {
			return {
				processing: false,
				Post: new Form({
					testimonial: '',
				}),
			}
		},
	}
</script>