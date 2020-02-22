<template>
	<ul class="steps is-vertical">
    	<slot></slot>

    	<div>
    		<button class="button is-primary is-inverted is-outlined">Invert Outlined</button>
			<button v-show="isnext" class="button is-link is-inverted is-outlined" @click="nextStepper">Next</button>
    	</div>
    </ul>
</template>

<script>
	export default {
		data() {
			return {
				isnext: true,
				steppers: [],
			}
		},

		computed: {
			currentIndex() {
				return this.steppers.findIndex( ({ isActive }) => isActive === true );
			},
			nextIndex() {
				return this.steppers.findIndex( ({ isActive }) => isActive === true ) + 1;
			},
		},

		created () {
			this.steppers = this.$children;
			Event.$on('isActive', data => this.selectStep(data));
		},

		methods: {
			selectStep(selectedStepper) {
				// console.log('you got here');
				this.steppers.forEach(stepper => {
					stepper.isActive = (stepper.name == selectedStepper);
				});
			},

			nextStepper() {
				let count = this.currentIndex
				this.steppers.forEach(stepper => {
					
					stepper.isActive = (stepper.name === this.steppers[count + 1].name);
					count = this.currentIndex;

					console.log('after reset to currentIndex');
					console.log(count);

					console.log('currentIndex');
					console.log(this.currentIndex);
				});
			}
		}
	}
</script>