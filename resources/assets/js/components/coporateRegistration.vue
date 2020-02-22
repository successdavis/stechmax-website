\<template>
	<div>
		<div class="field is-grouped is-grouped-multiline" v-if="step == 1">
			<div class="is-size-4">Please select your subject of interest</div> <br>
			<div class="control" v-for="subject in subjects">
				<div class="tags are-medium has-addons">
					<label class="checkbox">
						<a class="tag" :class="isChecked(subject.id) ? 'is-link' : ''">
							<input type="checkbox" class="no_check" :id="subject.id" :value="subject.id" v-model="checkedSubjects">
							{{subject.name}}
						</a>
						<a class="tag" v-if="isChecked(subject.id)">Remove</a>
						<a class="tag" v-if="! isChecked(subject.id)">Add</a>
					</label>
				</div>
			</div>
		</div>
		<div v-if="step == 2">
			<div>Displaying courses and tracks based on the subjects you have selected</div>
			<h2>Courses</h2>
			<div class="control" v-for="course in courses">
				<div class="tags are-medium has-addons">
					<label class="checkbox">
						<a class="tag" :class="courseIsChecked(course.id) ? 'is-link' : ''">
							<input type="checkbox" class="no_check" :id="course.id" :value="course.id" v-model="coporateForm.courses">
							{{course.title}}
						</a>
						<a class="tag" v-if="courseIsChecked(course.id)">Remove</a>
						<a class="tag" v-if="! courseIsChecked(course.id)">Add</a>
					</label>
				</div>
			</div>
			<h2>Tracks</h2>
			<div class="control" v-for="track in tracks">
				<div class="tags are-medium has-addons">
					<label class="checkbox">
						<a class="tag" :class="courseIsChecked(track.id) ? 'is-link' : ''">
							<input type="checkbox" class="no_check" :id="track.id" :value="track.id" v-model="coporateForm.courses">
							{{track.title}}
						</a>
						<a class="tag" v-if="courseIsChecked(track.id)">Remove</a>
						<a class="tag" v-if="! courseIsChecked(track.id)">Add</a>
					</label>
				</div>
			</div>
		</div>
		<div v-if="step == 3" class="mb-3">
			<h2>Please fill this Form to complete your application</h2>
			<div>
				<div class="field">
				  <label class="label">Endgoal</label>
				  <div class="control">
				    <textarea v-model="coporateForm.endgoal" class="textarea" placeholder="In a summary discuss what you wish you could be able to do at the end of this course e.g. I wish to be able to type and format a document"></textarea>
				  </div>
				  <p class="help" v-if="coporateForm.errors.has('endgoal')" v-text="coporateForm.errors.get('endgoal')"></p>
				</div>

				<div class="field">
				  <label class="label">When should this lectures begin?</label>
				  <div class="control">
				    <input type="date" v-model="coporateForm.begin_at" class="input"></input>
				  </div>
				  <p class="help" v-if="coporateForm.errors.has('begin_at')" v-text="coporateForm.errors.get('begin_at')"></p>
				</div>

				<div class="field">
				  <label class="label">Where should the lectures take place?</label>
				  <div class="control">
				    <input type="text" class="input" v-model="coporateForm.venue" placeholder="Please indicate none if you wish to recieve lectures at our ICT room"></input>
				  </div>
				  <p class="help" v-if="coporateForm.errors.has('venue')" v-text="coporateForm.errors.get('venue')"></p>
				</div>

				<div>Do you have a Personal Computer</div>
				<div class="control">
				  <label class="radio">
				    <input type="radio" v-model="coporateForm.personal_pc" id="one" value="Yes">
				    Yes
				  </label>
				  <label class="radio">
				    <input type="radio" v-model="coporateForm.personal_pc" id="two" value="No">
				    No
				  </label>
				</div>
				  <p class="help" v-if="coporateForm.errors.has('personal_pc')" v-text="coporateForm.errors.get('personal_pc')"></p>
			</div>
		</div>
		<div v-if="step == 4">
			<div class="has-text-centered">
				<div>Please schedule your days for lectures</div>
				<p>Its not compulsory to fill all three</p>
			</div>
			<form @submit.prevent="postcoporateform" @keydown="coporateForm.errors.clear()">
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Schedule One</label>
				  </div>
				  <div class="field-body">
				    <div class="field">
				      <p class="control is-expanded has-icons-left">
					    <div class="select is-primary is-fullwidth">
					      <select class="is-fullwidth" v-model="coporateForm.schedule.one.day">
					        <option value="">Pick a Day</option>
					        <option v-for="day in days" v-text="day" ></option>
					      </select>
					    </div>
				      </p>
				    </div>
				    <div class="field">
				      <p class="control is-expanded has-icons-left has-icons-right">
				        <input v-model="coporateForm.schedule.one.lecturetime" class="input is-success" type="time" placeholder="Please specify time for lecture">
				      </p>
				    </div>
				  </div>
				</div>
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Schedule Two</label>
				  </div>
				  <div class="field-body">
				    <div class="field">
				      <p class="control is-expanded has-icons-left">
					    <div class="select is-primary is-fullwidth">
					      <select class="is-fullwidth" v-model="coporateForm.schedule.two.day">
					        <option value="">Pick a Day</option>
					        <option v-for="day in days" v-text="day" ></option>
					      </select>
					    </div>
				      </p>
				    </div>
				    <div class="field">
				      <p class="control is-expanded has-icons-left has-icons-right">
				        <input v-model="coporateForm.schedule.two.lecturetime" class="input is-success" type="time" placeholder="Please specify time for lecture">
				      </p>
				    </div>
				  </div>
				</div>
				<div class="field is-horizontal">
				  <div class="field-label is-normal">
				    <label class="label">Schedule Three</label>
				  </div>
				  <div class="field-body">
				    <div class="field">
				      <p class="control is-expanded has-icons-left">
					    <div class="select is-primary is-fullwidth">
					      <select class="is-fullwidth" v-model="coporateForm.schedule.three.day">
					        <option value="">Pick a Day</option>
					        <option v-for="day in days" v-text="day" ></option>
					      </select>
					    </div>
				      </p>
				    </div>
				    <div class="field">
				      <p class="control is-expanded has-icons-left has-icons-right">
				        <input v-model="coporateForm.schedule.three.lecturetime" class="input is-success" type="time" placeholder="Please specify time for lecture">
				      </p>
				    </div>
				  </div>
				</div>

			  <p class="help" v-if="coporateForm.errors.has('schedule')" v-text="coporateForm.errors.get('schedule')"></p>

				<button :disabled="submitting" class="button is-success is-fullwidth">Request a quote</button>
			</form>
		</div>
		<div v-if="step == 5" class="has-text-centered">
			<div class="is-size-4">Thank you for for choosing S-Techmax to improve your/company IT Skills</div>
			<p>One of our agent will contact you shortly</p>
		</div>
		<div class="mt-3" v-if="step !== 5">
			<button class="button is-success" @click="step --" v-if="step > 1">Prev</button>
			<button class="button is-success" @click="step ++" v-if="maxSteps != step">Next</button>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['subjects'],
		data () {
			return {
				submitting: false,
				maxSteps: 4,
				step: 1,
				days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
				subjectcourses: '',
				checkedSubjects: [],
				coporateForm: new Form ({
					schedule: {
						one : {
							day: '',
							lecturetime: ''
						},
						two : {
							day: '',
							lecturetime: ''
						},
						three : {
							day: '',
							lecturetime: ''
						},
					},
					courses: [],
					endgoal: '',
					begin_at: '',
					venue: '',
					personal_pc: '',
				}),
			}
		},

		watch: {
			checkedSubjects () {
				this.getCourses();
			}
		},

		computed: {
            courses() {
                return this.subjectcourses.filter(course => course.type_id == 1);
            },

            tracks() {
                return this.subjectcourses.filter(course => course.type_id == 2);
            },
        },

		methods: {
			isChecked(id) {
				return this.checkedSubjects.includes(id);
			},
			
			courseIsChecked(id) {
				return this.coporateForm.courses.includes(id);
			},
			
			postcoporateform() {
				this.submitting = true;
				this.coporateForm.post('/coporate/registration')
				.then(data => {
					flash('Thank you! Our agent will contact you within a few hours');
					this.step = 5;
				})
				.catch(error => {
					this.submitting = false;
					flash('Something went wrong, All fields are required', 'failed');
				})
			},

			getCourses() {
				axios.get('/api/subjectcourses', {params: {subjects: this.checkedSubjects}})
				.then( data => {
					console.log(data);
					this.subjectcourses = data.data;
				})
			}
		},

		mounted () {

		}
	};
</script>

<style>
	.no_check {
		display: none;
	}
</style>