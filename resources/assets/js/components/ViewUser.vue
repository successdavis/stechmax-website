<template>
    <div>
        <a @click="$modal.show(modal)" href="#/client/15" class="button is-small is-primary">
          <span class="icon is-small"><i class="mdi mdi-account-edit"></i></span>
        </a>
        <modal :name="modal" height="auto" draggable=".window-header" class="scroll">
             <div class="card">
              <header class="card-header">
                <p class="uppercasewords card-header-title" v-text="Form.surname + ' ' + Form.last_name"></p>
                <div class="field card-header-icon">
                  <b-switch :value="false" v-model="editing" @change="update">
                      <span v-text="editing ? 'Save' : 'Edit' "></span>
                  </b-switch>
              </div>
                <!-- <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                </a> -->
              </header>
              <div class="card-content">
                <div class="content">
                  <div class="columns">
                    <div class="column is-offset-one-fifth">
                      <div>
                        <div class="button experience-btn" type="button">
                          <span @click="toggleExperiencePane">Award EXP</span>

                          <div class="experience-pane" v-if="awardingExperience">
                              <form>
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
                          </div>
                        </div>
                        <button class="button">
                          <a target="_blank" :href="'/users/generatecmdcard/' + username">PMT CARD</a>
                        </button>
                      </div>
                      <div class="columns">
                        <div class="column is-3">
                          <passport-form :user="selecteduser"></passport-form>
                        </div>
                        <div class="column">
                          <div class="user-passport--info">
                            <p><strong>Member Since:</strong> <br> {{date_joined}} </p>
                            <div class="grid-x grid-padding-x">
                              <p class="cell medium-6"><strong>Email:</strong> <br> {{email}} </p>
                              <p class="cell medium-6"><strong>User Id:</strong> <br> {{user_id}} </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="columns is-multiline">
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Surname</label>
                        <p class="control has-icons-right">
                          <input placeholder="Surname" class="input" type="text" v-model="Form.surname" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('surname')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('surname')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Middle Name</label>
                        <p class="control has-icons-right">
                          <input placeholder="Middle Name" class="input" type="text" v-model="Form.middle_name" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('middle_name')"></span>
                            <span class="mdi mdi-check" v-else></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Last Name</label>
                        <p class="control has-icons-right">
                          <input placeholder="Last Name" class="input" type="text" v-model="Form.last_name" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('last_name')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('last_name')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Gender</label>
                        <p class="control has-icons-right">
                          <input placeholder="Gender" class="input" type="text" v-model="Form.gender" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('gender')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('gender')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Username</label>
                        <p class="control has-icons-right">
                          <input placeholder="Username" class="input" type="text" v-model="Form.username" readonly>
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-check"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Date of Birth</label>
                        <p class="control has-icons-right">
                          <input placeholder="Date of Birth" class="input" type="date" v-model="Form.dob" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('dob')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('dob')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Phone 1</label>
                        <p class="control has-icons-right">
                          <input placeholder="Phone 1" class="input" type="text" v-model="Form.phone" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('phone')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('phone')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Phone 2</label>
                        <p class="control has-icons-right">
                          <input placeholder="Phone 2" class="input" type="text" v-model="Form.alternative_phone" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('alternative_phone')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('alternative_phone')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!--  -->
                    <div class="column is-4">
                      <div class="field">
                        <label class="label">Address</label>
                        <p class="control has-icons-right">
                          <input placeholder="Address" class="input" type="text" v-model="Form.address" :readonly="!editing">
                          <span class="icon is-small is-right" v-if="editing">
                            <span class="mdi mdi-close-circle-outline" v-if="Form.errors.has('address')"></span>
                            <span class="mdi mdi-check" v-if="! Form.errors.has('address')"></span>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div>Subscription History</div>
                  <div>
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
                </div>
              </div>
            </div>
        </modal>
    </div>
    
</template>

<script>
    export default {
        props: ['modal', 'selecteduser'],
        name: "ViewUser",

        data () {
          return {
            iPoints: this.selecteduser.points,
            editing: false,
            date_joined: this.selecteduser.Date_Joined,
            email: this.selecteduser.email,
            user_id: this.selecteduser.user_id,
            username: this.selecteduser.username,
            errorMsg: '',
            courses: this.selecteduser.courses,
            points: '',
            expdescription: '',
            examtitle: '',
            awardingExperience: false,
            processing: false,

            Form: new Form ({
                surname: this.selecteduser.f_name,
                last_name: this.selecteduser.l_name,
                middle_name: this.selecteduser.m_name,
                gender: this.selecteduser.gender,
                phone: this.selecteduser.phone,
                dob: this.selecteduser.dob,
                address: this.selecteduser.r_address,
                alternative_phone: this.selecteduser.alternative_phone,
                username: this.selecteduser.username,
                passport_path: this.selecteduser.passport_path,
            })
            
          }
        },

        computed: {
          getExpDescription() {
            return this.expdescription != 'examscore' ? this.expdescription : 'Exam: ' + this.examtitle;
          }
        },

        methods: {
          update () {
            if (!this.editing) {
              this.Form.patch(`/users/${this.selecteduser.username}/update`)
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

          toggleExperiencePane() {
            if (this.awardingExperience) {
                return this.awardingExperience = false
            }
            return this.awardingExperience = true
          },

          awardExperience() {
            this.processing = true;
            axios.post(`/api/${this.selecteduser.username}/awardexperience`, {points: this.points, description: this.getExpDescription})
              .then(() => {
                flash('Points Awarded');
                this.awardingExperience = false;
                this.processing = false;
                this.iPoints = +this.iPoints + +this.points;
                this.points = '';
              })
              .catch(error => {
                this.processing = false;
                flash('Unable to award Experience Points', 'failed');
              })
          }
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
