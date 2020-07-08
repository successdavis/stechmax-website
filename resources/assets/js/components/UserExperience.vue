<template>
	<div class="button experience-btn" type="button">
	    <span @click="toggleExperiencePane">Experience</span>

	    <div class="experience-pane" v-if="awardingExperience">
	    	<b-switch :value="false" v-model="award" @change="update">
              	<span style="color: yellow;" v-text="award ? 'Award' : 'Strip' "></span>
          	</b-switch>
          	<form v-if="award">
              	<h2 style="color: yellow;" v-text="iPoints"></h2>
              	<div class="field">
                	<div class="control">
	                  	<div class="select is-primary is-fullwidth">
		                    <select v-model="expdescription">
		                      <option value="" disabled>Description</option>
		                      <option>Attendance</option>
		                      <option>Completed a classwork</option>
		                      <option>Completed an assignment</option>
		                      <option value="examscore">Exam score</option>
		                      <option>Presentation</option>
		                      <option>Administrator Giveaway</option>
		                    </select>
	                  	</div>
                	</div>
              	</div>
              	<div class="field" v-show="expdescription == 'examscore'">
                	<div class="control">
                  		<input v-model="examtitle" class="input is-primary" type="text" placeholder="Please Type Course Title">
                	</div>
              	</div>
              	<div class="columns">
                	<div class="column is-9">
                  		<input class="input" type="number" name="points" v-model="points" placeholder="Specify points to Award">
                	</div>
	                <div class="column is-3">
	                  	<button :class="processing ? 'is-loading' : ''" class="medium button" @click.prevent="awardExperience">Award</button>
	                </div>
            	</div>
        	</form>
          	<form v-else>
              	<h2 style="color: yellow;" v-text="iPoints"></h2>
              	<div class="field">
                	<div class="control">
	                  	<div class="select is-primary is-fullwidth">
		                    <select v-model="points">
		                      <option value="" disabled>Description</option>
		                      <option v-for="(item, index) in stripvalues" :value="item">{{item.description}}</option>
		                    </select>
	                  	</div>
                	</div>
              	</div>
                <div>
                  	<button :class="processing ? 'is-loading' : ''" class="medium button" @click.prevent="stripExperience">Strip</button>
                </div>
        	</form>
	    </div>
	</div>	
</template>

<script>
	export default {
		props: ['user'],

		data() {
			return {
				award: true,
				iPoints: this.user.points,
	            awardingExperience: false,
	            processing: false,
	            points: '',
	            expdescription: '',
            	examtitle: '',
            	stripvalues: [
            		{
            			description: 'Issued Suspension',
            		    points: 200,
            		}
            	],
			}
		},

		computed: {
          	getExpDescription() {
            	return this.expdescription != 'examscore' ? this.expdescription : 'Exam: ' + this.examtitle;
          	}
        },
        methods: {

          toggleExperiencePane() {
            if (this.awardingExperience) {
                return this.awardingExperience = false
            }
            return this.awardingExperience = true
          },

          awardExperience() {
            this.processing = true;
            axios.post(`/api/${this.user.username}/awardexperience`, {points: this.points, description: this.getExpDescription})
              .then(() => {
                flash('Points Awarded');
                this.processing = false;
                this.iPoints = +this.iPoints + +this.points;
                this.points = '';
              })
              .catch(error => {
                this.processing = false;
                flash('Unable to award Experience Points', 'failed');
              })
          },

          stripExperience() {
            this.processing = true;
            axios.post(`/api/${this.user.username}/stripexperience`, {points: this.points.points, description: this.points.description})
              .then(() => {
                flash('Points Striped');
                this.processing = false;
                this.iPoints = +this.iPoints + -this.points.points;
                this.points = '';
              })
              .catch(error => {
                this.processing = false;
                flash('Unable to award Experience Points', 'failed');
              })
          },

          update() {
          	this.award = false;
          }
        }
	};
</script>


<style scoped>

/*.experience-btn {
  position: relative;
}*/

.experience-pane {
    position: absolute;
    top: 42px;
    background: #222a38;
    min-width: 500px;
    left: -100px;
    padding: 1em;
    z-index: 2;
}
</style>
