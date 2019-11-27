<template>
    <div>
        <button @click="$modal.show(modal)" class="small button">View User</button>
        <modal :name="modal" height="auto" draggable=".window-header" class="scroll">
              <div class="user-header">
                <h3 v-text="Form.surname + ' ' + Form.last_name"></h3>
                <div class="switch">
                    <p class="text" v-text="editing ? 'Done' : 'Edit User' "></p>
                    <input class="switch-input" id="exampleSwitch" type="checkbox" name="exampleSwitch" v-model="editing" @change="update">
                  <label class="switch-paddle" for="exampleSwitch">
                    <span class="show-for-sr">Edit User</span>
                  </label>
                </div>
              </div>

            <div class="user-passport grid-container">
                <passport-form :user="selectedUser"></passport-form>
                <div class="user-passport--info">
                  <p style="padding-left: 15px"><strong>Member Since:</strong> <br> {{date_joined}} </p>
                  <div class="grid-x grid-padding-x">
                    <p class="cell medium-6"><strong>Email:</strong> <br> {{email}} </p>
                    <p class="cell medium-6"><strong>User Id:</strong> <br> {{user_id}} </p>
                  </div>
                </div>
            </div>
            <form class="mb-4">
              <div class="grid-container">
                <div class="grid-x grid-padding-x">
                  <div class="medium-4 cell">
                    <label>Surname Name
                      <input type="text" v-model="Form.surname" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('surname')" v-text="Form.errors.get('surname')" id="subjectHelpText"></p>

                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Middle Name
                      <input type="text" v-model="Form.middle_name" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('middle_name')" v-text="Form.errors.get('middle_name')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Last Name
                      <input type="text" v-model="Form.last_name" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('last_name')" v-text="Form.errors.get('last_name')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Gender
                      <input type="text" v-model="Form.gender" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('gender')" v-text="Form.errors.get('gender')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Username
                      <input type="text" v-model="Form.username" disabled>
                      <p class="help-text" v-if="Form.errors.has('username')" v-text="Form.errors.get('username')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Date of Birth
                      <input type="date" v-model="Form.dob" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('dob')" v-text="Form.errors.get('dob')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Phone 1
                      <input type="text" v-model="Form.phone" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('phone')" v-text="Form.errors.get('phone')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Phone 2
                      <input type="text" v-model="Form.alternative_phone" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('alternative_phone')" v-text="Form.errors.get('alternative_phone')" id="subjectHelpText"></p>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Address
                      <input type="text" v-model="Form.address" :disabled="!editing">
                      <p class="help-text" v-if="Form.errors.has('address')" v-text="Form.errors.get('address')" id="subjectHelpText"></p>
                    </label>
                  </div>
                </div>
              </div>
            </form>
            <div class="grid-container">
              <h4>Subscription History</h4>
              <table class="mt-1">
                <thead>
                  <th>Active</th>
                  <th>Title</th>
                  <th>Subscribed On</th>
                  <th>Subscription Ends at</th>
                </thead>
                <tbody>
                  <tr v-for="data in courses">
                    <td v-text="data.status"></td>
                    <td><a :href="data.path" v-text="data.course.title"></a></td>
                    <td v-text="data.subscribedOn"></td>
                    <td v-text="data.subscribtionEndAt"></td> 
                  </tr>
                </tbody>
              </table>
            </div>
        </modal>
    </div>
    
</template>

<script>
    export default {
        props: ['modal', 'selectedUser'],
        name: "ViewUser",

        data () {
          return {
            editing: false,
            date_joined: this.selectedUser.Date_Joined,
            email: this.selectedUser.email,
            user_id: this.selectedUser.user_id,
            errorMsg: '',
            courses: '',

            Form: new Form ({
                surname: this.selectedUser.f_name,
                last_name: this.selectedUser.l_name,
                middle_name: this.selectedUser.m_name,
                gender: this.selectedUser.gender,
                phone: this.selectedUser.phone,
                dob: this.selectedUser.dob,
                address: this.selectedUser.r_address,
                alternative_phone: this.selectedUser.alternative_phone,
                username: this.selectedUser.username,
                passport_path: this.selectedUser.passport_path,
            })
            
          }
        },

        created () {
          axios.get(`/dashboard/${this.selectedUser.username}/getusercourses`)
            .then(response => {
              this.courses = response.data.data
            }
          );
        },

        methods: {
          update () {
            if (!this.editing) {
              this.Form.patch(`/users/${this.selectedUser.username}/update`)
                .then(() => {
                      flash('User updated Successfully')
                      this.$emit('userUpdated')
                })
                .catch(error => {
                    this.errorMsg = error.message;
                    flash('Something went wrong updating this user')
                    this.editing = true;
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
