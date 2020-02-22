<template>
	<li class="steps-segment" :class="isActive ? 'is-active' : ''">
        <span href="#" class="steps-marker" v-text="label" @click="setActive"></span>
        <div class="steps-content" >
          	<p class="is-size-4" v-text="name"></p>
          	<div v-if="isActive">
          		<slot></slot>
          	</div>
        </div>
    </li>
</template>

<script>
	export default {
		props: {
			name: { required: true},
			label: {required: true},
			selected: {default: false},
		},
		
		data () {
			return {
				isActive: false,
			}
		},

		mounted () {
			this.isActive = this.selected;
		},

		methods: {
			setActive() {
				this.isActive = true;
				Event.$emit('isActive', this.name);
			}
		}
	}
</script>