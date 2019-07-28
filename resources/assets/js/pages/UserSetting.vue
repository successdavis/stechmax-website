<template>
	<div class="grid-container">
	  <div class="grid-x grid-margin-x mt-4 mb-3">
	    <div class="cell medium-3 mt-4">
	      <ul class="vertical tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-tabs id="example-tabs">
	        <li class="tabs-title is-active"><a href="#general" aria-selected="true">General</a></li>
	        <li class="tabs-title"><a href="#Security">Security</a></li>
	        <li class="tabs-title"><a href="#Guardian">Guardian</a></li>
	        <li class="tabs-title"><a href="#Payment">Update Payment</a></li>
	      </ul>
	    </div>
	    <div class="cell medium-9">

		<div class="user-header">
			<h3>UPDATE SETTINGS</h3>
			<div class="switch">
			    <p class="text" v-text="editing ? 'Done?' : 'Edit Data' "></p>
			    <input class="switch-input" id="exampleSwitch" type="checkbox" name="exampleSwitch" v-model="editing" @change="updateGeneral">
			  <label class="switch-paddle" for="exampleSwitch">
			    <span class="show-for-sr">Edit</span>
			  </label>
			</div>
		</div>

	    <div class="tabs-content" data-tabs-content="example-tabs">
	        <div class="tabs-panel is-active mt-2 mb-3" id="general">
				<form>
				  <div class="grid-container">
				    <div class="grid-x grid-padding-x">
				      <div class="medium-6 cell">
				        <label>Surname
				          <input type="text" placeholder="Type Your Surname Here" v-model="General_Form.f_name" :disabled="!editing">
		                    <p class="help-text" v-if="General_Form.errors.has('f_name')" v-text="General_Form.errors.get('f_name')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Middle Name
				          <input type="text" placeholder="Type your Middle " v-model="General_Form.m_name" :disabled="!editing">
		                    <p class="help-text" v-if="General_Form.errors.has('m_name')" v-text="General_Form.errors.get('m_name')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Last Name
				          <input type="text" placeholder="Type your Middle " v-model="General_Form.l_name" :disabled="!editing">
		                  <p class="help-text" v-if="General_Form.errors.has('l_name')" v-text="General_Form.errors.get('l_name')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Gender
				          <select v-model="General_Form.gender" :disabled="!editing">
				          	<option value="M">Male</option>
				          	<option value="F">Female</option>
				          </select>
		                  <p class="help-text" v-if="General_Form.errors.has('gender')" v-text="General_Form.errors.get('gender')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Date of Birth
				        	<input type="date" v-model="General_Form.dob" :disabled="!editing">
		                    <p class="help-text" v-if="General_Form.errors.has('dob')" v-text="General_Form.errors.get('dob')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Phone
				        	<input type="text" v-model="General_Form.phone" :disabled="!editing">
		                    <p class="help-text" v-if="General_Form.errors.has('phone')" v-text="General_Form.errors.get('phone')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Alternative Phone
				        	<input type="text" v-model="General_Form.alternative_phone" :disabled="!editing">
		                    <p class="help-text" v-if="General_Form.errors.has('alternative_phone')" v-text="General_Form.errors.get('alternative_phone')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Residential Address
				        	<input type="text" v-model="General_Form.r_address" :disabled="!editing">
		                    <p class="help-text" v-if="General_Form.errors.has('r_address')" v-text="General_Form.errors.get('r_address')" id="subjectHelpText"></p>
				        </label>
				      </div>
				    </div>
				  </div>
				</form>
	        </div>

	        <!-- SECURITY TAB FORM -->
	        <div class="tabs-panel" id="Security">
	          <form @submit.prevent="updatePassword">
				  <div class="grid-container">
				    <div class="grid-x grid-padding-x">
				      <div class="medium-6 cell">
				        <label>Email Address
				          <input type="text" placeholder="Type Your Surname Here" v-model="Security_Form.email" disabled>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Username
				          <input type="text" placeholder="Type your Middle " v-model="Security_Form.username" disabled>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Old Password
				        	<input type="Password" placeholder="Type your Middle " v-model="Security_Form.old_password" >
							<p class="help-text" v-if="Security_Form.errors.has('old_password')" v-text="Security_Form.errors.get('old_password')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>New Password
				          <input type="Password" placeholder="Type your Middle " v-model="Security_Form.new_password">
							<p class="help-text" v-if="Security_Form.errors.has('new_password')" v-text="Security_Form.errors.get('new_password')" id="subjectHelpText"></p>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Confirm New Password
				          <input type="Password" placeholder="Type your Middle " v-model="Security_Form.confirm_password">
							<p class="help-text" v-if="Security_Form.errors.has('confirm_password')" v-text="Security_Form.errors.get('confirm_password')" id="subjectHelpText"></p>
				        </label>
				      </div>
				    </div>
				    <button class="medium button" type="submit">Submit</button>
				  </div>
				</form>
	        </div>

	        <!-- GUARDIAN TAB FORM -->
	        <div class="tabs-panel" id="Guardian">
	          <form @submit.prevent="Post_Guardian_Form">
				  <div class="grid-container">
				    <div class="grid-x grid-padding-x">
				      <div class="medium-6 cell">
				        <label>Email Address
				          <input type="text" placeholder="Type Email Address Here" v-model="Guardian_Form.email">
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Title
				          <select v-model="Guardian_Form.title">
				          	<option value="Mr">Mr</option>
				          	<option value="Dr">Dr</option>
				          	<option value="Bar">Bar</option>
				          	<option value="Mrs">Mrs</option>
				          	<option value="Miss">Miss</option>
				          	<option value="Others">Others</option>
				          </select>
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Name
				          <input type="text" placeholder="Surname  First Name   Last Name  " v-model="Guardian_Form.name" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Occupation
				          <input type="text" placeholder="Work work does he/she does? " v-model="Guardian_Form.occupation" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Company working for
				          <input type="text" placeholder="What company does he/she works for? " v-model="Guardian_Form.company_name" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Work Address
				          <input type="text" placeholder="Where is this company located? " v-model="Guardian_Form.work_address" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Residential Address
				          <input type="text" placeholder="Where does he/she lives " v-model="Guardian_Form.r_address" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Relationship
				          <input type="text" placeholder="What is your relationship with this person" v-model="Guardian_Form.relationship" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Phone
				          <input type="text" placeholder="Please provide us a means of contacting him" v-model="Guardian_Form.phone" >
				        </label>
				      </div>
				      <div class="medium-6 cell">
				        <label>Alternative Phone
				          <input type="text" placeholder="Which other contact can we reach this person " v-model="Guardian_Form.alternative_phone" >
				        </label>
				      </div>
				      <button class="medium button" @click="Post_Guardian_Form" v-text="active ? 'Update Guardian' : 'Create Guardian'"></button>
				    </div>
				  </div>
				</form>
	        </div>
	        <div class="tabs-panel" id="Payment">
	          <p>Hi {{User.f_name}} !</p>
	          <p>Section Under Maintenance</p>
	        </div>
	      </div>
	    </div>
	  </div>
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
          updateGeneral () {
            if (!this.editing) {
              this.General_Form.patch(`/dashboard/${this.User.username}/updateprofile`)
                .then(() => {
                      flash('General settings updated')
                      this.$emit('userUpdated')
                })
                .catch(error => {
                    flash('Something went wrong updating the ' + this.panel + ' settings')
                    this.editing = true;
                });
            }
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
	}
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
