<template>
	<form @submit.prevent="createInvoice" @change="errorMessage=''">
		<transition
	        name="custom-classes-transition"
	        enter-active-class="animated slideInDown"
	        leave-active-class="animated slideOutUp"
	    >
			<p v-if="errorMessage" class="errorMessage" v-text="errorMessage"></p>
		</transition>
	  <div class="columns is-multiline">
			<div class="column is-6">
				<div class="field">
				  <label class="label">Who is payingfor this Invoice?</label>
				  <div class="control">
				  	<div class="select is-fullwidth">
					  <select class="is-fullwidth" v-model="Form.user" required>
					    <option value="">Click to select a a User</option>
				    	<option v-for="user in Data.users" :value="user.id" v-text="user.f_name + ' ' + user.l_name"></option>
					  </select>
					</div>
				  </div>
				</div>
			</div>
			<div class="column is-6">
				<div class="field">
				  <label class="label">Whats is the user payingfor for?</label>
				  <div class="control">
				  	<div class="select is-fullwidth">
					  <select v-model="Form.payingfor" required class="is-fullwidth">
					    <option selected value="">Click to select a payment category</option>
						<option v-for="item in payable" :value="item" v-text="item"></option>
					  </select>
					</div>
				  </div>
				</div>
			</div>
	      	<div class="column is-6" v-if="Form.payingfor === 'Course'">
	      		<div class="field">
			  		<label class="label">Select Course</label>
					<div class="control">
					  	<div class="select is-fullwidth">
						  <select v-model="Form.course" required class="is-fullwidth">
						  	<option selected value="">Pick a course</option>
						    <option v-for="course in Data.courses" :value="course.id" v-text="course.title"></option>
						  </select>
						</div>
					</div>
				</div>
			</div>

	      <div class="column is-6" v-if="Form.payingfor === 'Other'">
	        <label>Amount
	          <input type="number" placeholder="Type the Invoice Amount Here" required>
	        </label>
	      </div>
	      <div class="column is-6">
	      	<div class="field">
		  		<label class="label">Does this invoice support part-payments?</label>
				<div class="control">
				  	<div class="select is-fullwidth">
					  <select v-model="Form.partpayment" required class="is-fullwidth">
						<option selected value="">Click to select an Option</option>
					    <option value="1" v-text="'Yes'">Yes</option>
					    <option value="0" v-text="'No'">No</option>
					  </select>
					</div>
				</div>
			</div>
	      </div>
	      <div class="column is-6" v-if="Form.payingfor === 'Course'">
	      	<div class="field">
		  		<label class="label">Should the user be subscribe to this course?</label>
				<div class="control">
				  	<div class="select is-fullwidth">
					  <select v-model="Form.subscribeToCourse" required class="is-fullwidth">
					  	<option selected value="">Click to select an Option</option>
					    <option value="1" >Yes</option>
					    <option value="0" >No</option>
					  </select>
					</div>
				</div>
			</div>
	      </div>
	      <div class="column is-6" v-if="Form.payingfor === 'Course'">
			<div class="field">
		  		<label class="label">Is the user taking classroom lectures?</label>
				<div class="control">
				  	<div class="select is-fullwidth">
					  <select v-model="Form.classroom" required class="is-fullwidth">
						<option selected value="">Click to select an Option</option>
					    <option value="1" >Yes</option>
					    <option value="0" >No</option>
					  </select>
					</div>
				</div>
			</div>
	    	</div>
	  	</div>
    	<button class="medium button" :disabled="submitting">Submit</button>
	</form>

</template>

<script>
	export default {
		data () {
			return {
				Form: new Form({
                    course: '',
                    user: '',
                    partpayment: '',
                    subscribeToCourse: '',
                    classroom: '',
                    payingfor: '',
                }),
                payable: [
                	'Course',
                	'Handout',
                	'Certificate',
                	'Classroom',
                    'Graduation Ceremony',
                	'Other',
                ],
                submitting: false,
                errorMessage: '',
                Data: {
                    users: {},
                    courses: {},
                }
			}
		},

		created () {
            axios.get('/api/users/getallusers')
                .then(response => this.Data.users = response.data);

            axios.get('/api/courses/allcoursesandtracks')
                .then(response => this.Data.courses = response.data);
        },

        methods: {
        	createInvoice() {
        		this.submitting = true
        		this.Form.post('/dashboard/invoices/createinvoiceforuser')
                    .then(data => {
                            // this.Form.reset();
                            flash('We have applied invoice to this user.');
                    })
                .catch(error => {
                	this.errorMessage = error.message;
                    flash('We were unable to process your form','failed')
                    this.submitting = false;
                });
        	}
        }
	}

</script>

<style scoped>
	.errorMessage {
	    text-align: center;
	    color: white;
	    padding: 1em;
	    background: red;

	}
</style>
