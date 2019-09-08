<template>
	<form @submit.prevent="createInvoice" @change="errorMessage=''">
		<transition 
	        name="custom-classes-transition"
	        enter-active-class="animated slideInDown"
	        leave-active-class="animated slideOutUp"
	    >
			<p v-if="errorMessage" class="errorMessage" v-text="errorMessage"></p>
		</transition>
	  <div class="grid-container">
	    <div class="grid-x grid-padding-x">
	      <div class="medium-6 cell">
	        <label>Who is paying this Invoice?
			  <select v-model="Form.user" required>
			  	<option selected value="">Click to select a a User</option>
			    <option v-for="user in Data.users" :value="user.id" v-text="user.f_name + ' ' + user.l_name"></option>
			  </select>
			</label>
	      </div>
	      <div class="medium-6 cell">
	        <label>Whats is the user paying for?
			  <select v-model="paying" required>
			  	<option selected value="">Click to select a payment category</option>
			    <option v-for="item in PayingFor" :value="item" v-text="item"></option>
			  </select>
			</label>
	      </div>
	      <div class="medium-6 cell" v-if="paying == 'Course'">
	        <label>Select Course?
			  <select v-model="Form.course" required>
			  	<option selected value="">Pick a course</option>
			    <option v-for="course in Data.courses" :value="course.id" v-text="course.title"></option>
			  </select>
			</label>
	      </div>
	      <div class="medium-6 cell" v-if="paying == 'Other'">
	        <label>Amount
	          <input type="number" placeholder="Type the Invoice Amount Here" required>
	        </label>
	      </div>
	      <div class="medium-6 cell">
	        <label>Does this invoice support part-payments?
			  <select v-model="Form.partpayment" required>
			  	<option selected value="">Click to select an Option</option>
			    <option value="1" v-text="'Yes'">Yes</option>
			    <option value="0" v-text="'No'">No</option>
			  </select>
			</label>
	      </div>
	      <div class="medium-6 cell" v-if="paying == 'Course'">
	        <label>Should the user be subscribe to this course?
			  <select v-model="Form.subscribeToCourse" required>
			  	<option selected value="">Click to select an Option</option>
			    <option value="1" >Yes</option>
			    <option value="0" >No</option>
			  </select>
			</label>
	      </div>
	    </div>
	    <button class="medium button" :disabled="submitting">Submit</button>
	  </div>
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
                }),
                PayingFor: [
                	'Course',
                	'Material',
                	'Certificate',
                	'Classroom Fee',
                	'Other',
                ],
                paying: '',
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
                    flash('We were unable to process your form')
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