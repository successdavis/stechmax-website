<template>
	<div class="section">
	  <tabs :vertical="true">
	    	<tab name="General" :selected="true">
	    		<div class="card">
				  	<header class="card-header">
				    	<p class="card-header-title">
				      		PERSONAL INFORMATION
				    	</p>
				    	<div class="card-header-icon">
					    	<button 
					    		:class="editing ? 'is-warning' : ''" 
					    		class="button" 
					    		@click="updategeneral" 
					    		v-show="editing"
					    	>Save</button>
				    	</div>
					        <!-- <b-switch class="card-header-icon" :value="false" v-model="editing" @click="updategeneral">
			                	<span v-text="editing ? 'Save' : 'Edit Data'"></span>
			              	</b-switch> -->
					</header>
					  <div class="card-content">
					    <form @change="editing = true">
						  	<div class="columns is-multiline">
					      	<div class="column is-6">
					      		<div class="field">
					        		<label class="label">Surname</label>
					        		<div class="control">
						          	<input class="input" type="text" v-model="General_Form.f_name">
			                </div>
	                    <p class="help is-danger" v-if="General_Form.errors.has('f_name')" v-text="General_Form.errors.get('f_name')"></p>
			              </div>
					        </div>
					      	<div class="column is-6">
					      		<div class="field">
						        	<label class="label">Middle Name</label>
						        	<div class="control">
						          	<input class="input" type="text" v-model="General_Form.m_name">
				              </div>
	                    <p class="help is-danger" v-if="General_Form.errors.has('m_name')" v-text="General_Form.errors.get('m_name')"></p>
				            </div>
					      	</div>
						      <div class="column is-6">
						      	<div class="field">
							        <label class="label">Last Name</label>
						      		<div class="control">
							          <input class="input" type="text" v-model="General_Form.l_name">
						      		</div>
		                  <p class="help is-danger" v-if="General_Form.errors.has('l_name')" v-text="General_Form.errors.get('l_name')"></p>
						      	</div>
						      </div>
						      <div class="column is-6">
						      	<div class="field">
							        <label class="label">Gender</label>
						      		<div class="control is-fullwidth">
						      			<div class="select is-fullwidth">
								          <select v-model="General_Form.gender">
								          	<option value="M">Male</option>
								          	<option value="F">Female</option>
								          </select>
						      			</div>
						      		</div>
		                  <p class="help-text" v-if="General_Form.errors.has('gender')" v-text="General_Form.errors.get('gender')" id="subjectHelpText"></p>
						      	</div>
						      </div>
						      <div class="column is-6">
						        	<label class="label">Date of Birth</label>
						        	<input class="input" type="date" v-model="General_Form.dob">
	                    <p class="help-text" v-if="General_Form.errors.has('dob')" v-text="General_Form.errors.get('dob')" id="subjectHelpText"></p>
						      </div>
						      <div class="column is-6">
						      	<div class="field">
							        <label class="label">Phone</label>
						      		<div class="control">
							        	<input class="input" type="text" v-model="General_Form.phone">
						      		</div>
	                    <p class="help-text" v-if="General_Form.errors.has('phone')" v-text="General_Form.errors.get('phone')" id="subjectHelpText"></p>
						      	</div>
						      </div>
						      <div class="column is-6">
						      	<div class="field">
							        <label class="label">Alternative Phone</label>
						      		<div class="control">
							        	<input class="input" type="text" v-model="General_Form.alternative_phone">
						      		</div>
	                    <p class="help-text" v-if="General_Form.errors.has('alternative_phone')" v-text="General_Form.errors.get('alternative_phone')" id="subjectHelpText"></p>
					      		</div>
						      </div>
						      <div class="column is-6">
						      	<div class="field">
							        <label class="label">Residential Address</label>
						      		<div class="">
							        	<input class="input" type="text" v-model="General_Form.r_address">
						      		</div>
	                    <p class="help-text" v-if="General_Form.errors.has('r_address')" v-text="General_Form.errors.get('r_address')" id="subjectHelpText"></p>
						      	</div>
						      </div>
						    </div>
							</form>
					  </div>
					</div>
	    	</tab>
	    	<tab name="Security">
	    		<div class="card">
				  	<header class="card-header">
				    	<p class="card-header-title">
				      		SECURITY
				    	</p>
						</header>
					  <div class="card-content">
					    <form @submit.prevent="updatePassword">
							    <div class="columns is-multiline">
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Email Address</label>
							      		<div class="control">
								          <input type="text" class="input" v-model="Security_Form.email" disabled>
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Username</label>
							      		<div class="control">
								          <input class="input" type="text" v-model="Security_Form.username" disabled>
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Old Password</label>
							      		<div class="control">
								        	<input class="input" type="Password" v-model="Security_Form.old_password" >
							      		</div>
												<p class="help-text" v-if="Security_Form.errors.has('old_password')" v-text="Security_Form.errors.get('old_password')"></p>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">New Password</label>
							      		<div class="control">
								          <input class="input" type="Password" v-model="Security_Form.new_password">
							      		</div>
												<p class="help is-danger" v-if="Security_Form.errors.has('new_password')" v-text="Security_Form.errors.get('new_password')"></p>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label>Confirm New Password</label>
								        <div class="control">
								          <input class="input" type="Password" v-model="Security_Form.confirm_password">
								        </div>
												<p class="help is-danger" v-if="Security_Form.errors.has('confirm_password')" v-text="Security_Form.errors.get('confirm_password')"></p>
							      	</div>
							      </div>
							    </div>
							    <button type="submit" class="button">Submit</button>
							</form>
					  </div>
					</div>
	    	</tab>
	    	<tab name="Guardian">
	    		<div class="card">
				  	<header class="card-header">
				    	<p class="card-header-title">
				      		GUARDIAN INFORMATION
				    	</p>
						</header>
					  <div class="card-content">
			    		<form @submit.prevent="Post_Guardian_Form">
							    <div class="columns is-multiline">
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Email Address</label>
							      		<div class="control">
								          <input class="input" type="text" v-model="Guardian_Form.email">
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label>Title</label>
							      		<div class="control">
							      			<div class="select is-fullwidth">
									          <select class="is-fullwidth" v-model="Guardian_Form.title">
									          	<option value="">Select a title</option>
									          	<option value="Mr">Mr</option>
									          	<option value="Dr">Dr</option>
									          	<option value="Bar">Bar</option>
									          	<option value="Mrs">Mrs</option>
									          	<option value="Miss">Miss</option>
									          	<option value="Others">Others</option>
									          </select>
							      			</div>
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Full Name</label>
								        <div class="control">
								          <input class="input" type="text" placeholder="Surname First Name Last Name  " v-model="Guardian_Form.name" >
								        </div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Occupation</label>
							      		<div class="control">
								          <input class="input" type="text" placeholder="Work work does he/she does? " v-model="Guardian_Form.occupation" >
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Company working for</label>
							      		<div class="control">
								          <input class="input" type="text" placeholder="What company does he/she works for? " v-model="Guardian_Form.company_name" >
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Work Address</label>
							      		<div class="control">
								          <input class="input" type="text" placeholder="Where is this company located? " v-model="Guardian_Form.work_address" >
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Residential Address</label>
							      		<div class="control">
								          <input class="input" type="text" placeholder="Where does he/she lives " v-model="Guardian_Form.r_address" >
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label class="label">Relationship</label>
							      		<div class="control">
								          <input class="input" type="text" placeholder="What is your relationship with this person" v-model="Guardian_Form.relationship">
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label>Phone</label>
							      		<div class="control">
								          <input class="input" type="text" placeholder="Please provide us a means of contacting him" v-model="Guardian_Form.phone" >
							      		</div>
							      	</div>
							      </div>
							      <div class="column is-6">
							      	<div class="field">
								        <label>Alternative Phone</label>
								        <div class="control">
								          <input class="input" type="text" placeholder="Which other contact can we reach this person " v-model="Guardian_Form.alternative_phone" >
								        </div>
							      	</div>					      		
							      </div>
							    </div>
							      <button class="button" @click="Post_Guardian_Form" v-text="active ? 'Update Guardian' : 'Create Guardian'"></button>
							</form>
						</div>
					</div>
	    	</tab>
	    	<tab name="Payment Details"></tab>
		</tabs>
	</div>
</template>

<script>
	export default {
		props: ['User'],
		data() {
			return {
				editing: false,
				General_Form: new Form ({
					f_name: this.User.f_name,
					m_name: this.User.m_name,
					l_name: this.User.l_name,
					gender: this.User.gender,
					username: this.User.username,
					phone: this.User.phone,
					r_address: this.User.r_address,
					dob: this.User.dob,
					alternative_phone: this.User.alternative_phone,
					avatar_path:this.User.avatar_path,
				}),

				Security_Form: new Form ({
					email: this.User.email,
					username: this.User.username,
					old_password: '',
					new_password: '',
					confirm_password: '',
				}),

				Guardian_Form: new Form ({
					email: this.User.guardians !== null ? this.User.guardians.email : '',
					name: this.User.guardians !== null ? this.User.guardians.name : '',
					title: this.User.guardians !== null ? this.User.guardians.title : '',
					occupation: this.User.guardians !== null ? this.User.guardians.occupation : '',
					company_name: this.User.guardians !== null ? this.User.guardians.company_name : '',
					work_address: this.User.guardians !== null ? this.User.guardians.work_address : '',
					phone: this.User.guardians !== null ? this.User.guardians.phone : '',
					alternative_phone: this.User.guardians !== null ? this.User.guardians.alternative_phone : '',
					r_address: this.User.guardians !== null ? this.User.guardians.r_address : '',
					relationship: this.User.guardians !== null ? this.User.guardians.relationship : '',
				})
			}
		},

		computed: {
            active() {
                return this.User.guardians === null ? false : true
            }
        },

		methods: {
          updategeneral () {
          	this.General_Form.patch(`/dashboard/${this.User.username}/updateprofile`)
            .then(() => {
                  flash('General settings updated')
                  this.$emit('userUpdated')
            })
            .catch(error => {
                flash('Something went wrong updating the ' + this.panel + ' settings')
                this.editing = true;
            });
          },

          updatePassword () {
              this.Security_Form.patch(`/dashboard/${this.User.username}/updatepassword`)
                .then(() => {
                      flash('Security settings updated')
                      this.$emit('userUpdated')
                })
                .catch(error => {
                    flash('Something went wrong updating the security settings')
                });
          },

          Post_Guardian_Form () {
          	if (this.active) {
              this.Guardian_Form.patch(`/dashboard/${this.User.guardians.id}/updateguardian`)
                .then(() => {
                      flash('Guardian Updated')
                })
                .catch(error => {
                    flash('Sorry! Something went wrong')
                });
          	}else {
          		this.Guardian_Form.post(`/dashboard/${this.User.username}/createguardian`)
                .then(() => {
                    flash('New Guardian Added successfully')
                })
                .catch(error => {
                    flash('Sorry! Something adding wrong')
                });
          	}
          },
        }
	};
</script>

<style scoped>

.scroll {
    overflow: scroll;
}

.user-header,
.switch {
  display: flex;
}

.user-header {
  justify-content: space-between;
  background: #1b222d;
  color: white;
  align-items: center;
  border-bottom: 5px solid red;
  padding: .2em 1.5em;
}

.switch {
  margin-bottom: 0;
}

.text {
    display: inline-block;
    color: white;
    /* padding: 0; */
    margin: 0;
    align-self: center;
    padding-right: 1em;
  }

.user-passport{
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

.user-passport--info {
    margin-top: 32px;
    padding-left: 1em;
}
</style>
