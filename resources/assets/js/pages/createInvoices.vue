<template>
	<div>
		<form @submit.prevent="createInvoice" @change="errorMessage=''">
			<transition
		        name="custom-classes-transition"
		        enter-active-class="animated slideInDown"
		        leave-active-class="animated slideOutUp"
		    >
				<p v-if="errorMessage" class="errorMessage" v-text="errorMessage"></p>
			</transition>
			<section>
		        <b-field label="Enter Student Name">
		            <b-autocomplete
			            v-model="userfield"
		                ref="autocomplete"
		                :data="users"
		                size="is-medium"
		                :open-on-focus="true"
		                :clearable="true"
		                :loading="isLoading"
		                field="name"
		                @input="finduser"
		                @select="selecteduser">
		                <template #header>
		                    <a>
		                        <span> Add new... </span>
		                    </a>
		                </template>
		                <template #empty>No results for User</template>
		            </b-autocomplete>
		        </b-field>
		    </section>
		    <section v-if="selected" class="bg-white mt-3" style="padding: 1em">
		    	<div class="columns">
		    		<center class="column is-3">
		    			<figure class="image is-128x128">
						  <img class="is-rounded" :src="selected.passport_path">
						</figure>
		    		</center>
		    		<div class="column is-9">
		    			<h2 class="title" v-text="selected.name"></h2>
		    			<table>
		    				<tr>
		    					<th>ID No. :</th>
		    					<td v-text="selected.user_id"></td>
		    				</tr>
		    				<tr>
		    					<th>Email: </th>
		    					<td v-text="selected.email"></td>
		    				</tr>
		    				<tr>
		    					<th>Gender: </th>
		    					<td v-text="selected.gender"></td>
		    				</tr>
		    				<tr>
		    					<th>Date Joined: </th>
		    					<td v-text=" selected.Date_Joined"></td>
		    				</tr>
		    			</table>
		    		</div>
		    	</div>
		    </section>
		    <section v-if="selected" class="bg-white mt-3 p*" style="padding: 1em">
		    	<div class="columns is-multiline">
		    		<div class="column is-6 ">
						<div class="field">
						  	<label class="label">Payment for?</label>
							  <div class="control">
								  	<div class="select is-fullwidth">
									  <select v-model="Form.payingfor" required class="is-fullwidth">
									    <option selected value="">Billable:</option>
										<option v-for="item in payable" :value="item" v-text="item"></option>
									  </select>
									</div>
							  </div>
						</div>
					</div>

					<div class="column is-6" v-if="Form.payingfor === 'Course'">
				        <b-field label="Enter Course Title">
				            <b-autocomplete
					            v-model="coursefield"
				                ref="autocomplete"
				                :data="courses"
				                size="is-medium"
				                :open-on-focus="true"
				                :clearable="true"
				                :loading="isLoading"
				                field="title"
				                @input="findcourse"
				                @select="selectedcourse">
				                <template #header>
				                    <a>
				                        <span> Add new... </span>
				                    </a>
				                </template>
				                <template #empty>No course match your search</template>
				            </b-autocomplete>
				        </b-field>
				    </div>
				    <div class="column is-6" v-if="Form.payingfor === 'Course'">
			    		<label class="label">Accept Part-payments?</label>
		                <b-field>
				            <b-switch v-model="Form.partpayment">
				                {{ Form.partpayment }}
				            </b-switch>
				        </b-field>

				        <label class="label">Taking classroom Lectures?</label>
		                <b-field>
				            <b-switch v-model="Form.classroom">
				                {{ Form.classroom }}
				            </b-switch>
				        </b-field>
				    </div>


				    <div class="column is-6" v-if="Form.payingfor === 'Other'">
				    	<div class="column">
					        <label>Amount
					        	<input class="input" type="number" placeholder="Type the Invoice Amount Here" required>
					        </label>
					    </div>
				        <div class="column">
				        	<label>Description</label>
				        	<input class="input" type="text" name="Payment Description">
				        </div>
				    </div>
				</div>
		    </section>
		  	<div class="columns is-multiline">
			</div>
			<section class="mt-3" v-if="selected">
		    	<button :disabled="togInvBtn" class="is-large is-primary button" :class="isLoading ? 'is-loading' : '' ">Create</button>
			</section>
		</form>
		<a v-show="invoiceNo !== '' " class="button is-success" href="/dashboard/payments/addpayment">Manage Invoice</a>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				isLoading: false,
				togInvBtn: false,
				column: 'f_name',
				selected:'',
				per_page: '200',
				search: '',
				order: 'desc',
				invoiceNo: '',
				Form: new Form({
                    course: '',
                    user: '',
                    partpayment: true,
                    subscribeToCourse: true,
                    classroom: true,
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
                errorMessage: '',
                users: [],
                courses: {},
                coursefield: '',
                userfield: '',
			}
		},


		created () {
            this.preloadUsers();
        },

        watch: {
        	userfield: {
        		handler() {
	        		this.resetValues();
        		}
        	}
        },

        methods: {
        	preloadUsers() {
        		this.column		= 'created_at',
                this.per_page	= '10',
                this.fetch();
        	}, 
        	createInvoice() {
        		this.isLoading = true
        		this.Form.post('/dashboard/invoices/createinvoiceforuser')
                    .then(data => {
                    	this.invoiceNo = data.invoiceNo;
                    	localStorage.setItem('invoiceNo',data.invoiceNo);
                        flash('Invoice created for user.');
	                    this.isLoading = false;
	                    this.togInvBtn= true;
                    })
                .catch(error => {
                	this.errorMessage = error.message;
                    flash('Error processing! Please do no retry','failed')
                    this.isLoading = false;
                });
        	},

        	resetValues () {
        		this.coursefield = '';
        		this.Form.course = '';
        		this.Form.payingfor = '';
        		this.togInvBtn= false;
        	},

        	fetch() {
                axios.get('/dashboard/users/datatable', {
                    params: {
                    	column: this.column,
	                    order: this.order,
                        per_page: this.per_page,
                        search: this.search,
                    }
                }).then(({data}) => {
                	this.isLoading = false;
                    if (data.data.length) {
                    	this.users = data.data
                    }
                }).catch(error => {
                	flash('Something went wrong trying to find users', 'failed')
                });
            },

        	fetchCourses() {
                axios.get('/courses', {
                    params: {
                        search: this.searchCourse,
                    }
                }).then(({data}) => {
                	this.isLoading = false;
                    if (data.data.length) {
                    	this.courses = data.data
                    }
                }).catch(error => {
                	flash('Something went wrong trying to find users', 'failed')
                });
            },

            selectedcourse(course) {
            	this.Form.course = course.id;
            },

            selecteduser(user) {
            	if (user) {
	            	this.Form.user = user.id;
	            	this.selected = user;
            	} else {
            		this.selected = '',
            		this.Form.user = ''
            	}
            },

            finduser: _.debounce(function(search) {
                this.isLoading = true;
                this.search = search;
                this.users = [];
                this.fetch();
            }, 600),

            findcourse: _.debounce(function(search) {
                this.isLoading 		= true;
                this.searchCourse 	= search;
                this.courses 		= [];
                this.fetchCourses();
            }, 600),


        }
	};

</script>

<style scoped>
	.errorMessage {
	    text-align: center;
	    color: white;
	    padding: 1em;
	    background: red;

	}

	.p* {
		padding: 1em;
	}
</style>
