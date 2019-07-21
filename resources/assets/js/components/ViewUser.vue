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
                  <p><strong>Member Since:</strong> <br> {{date_joined}} </p>
                  <p><strong>Email:</strong> <br> {{email}} </p>
                </div>
            </div>
            <form class="mb-4">
              <div class="grid-container">
                <div class="grid-x grid-padding-x">
                  <div class="medium-4 cell">
                    <label>Surname Name
                      <input type="text" v-model="Form.surname" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Middle Name
                      <input type="text" v-model="Form.middle_name" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Last Name
                      <input type="text" v-model="Form.last_name" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Gender
                      <input type="text" v-model="Form.gender" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Username
                      <input type="text" v-model="Form.username" disabled>
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Date of Birth
                      <input type="date" v-model="Form.dob" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Phone 1
                      <input type="text" v-model="Form.phone" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Phone 2
                      <input type="text" v-model="Form.alternative_phone" :disabled="!editing">
                    </label>
                  </div>
                  <div class="medium-4 cell">
                    <label>Address
                      <input type="text" v-model="Form.address" :disabled="!editing">
                    </label>
                  </div>
                </div>
              </div>
            </form>
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

        methods: {
          update () {
            if (!this.editing) {
              this.Form.patch(`/users/${this.selectedUser.username}/update`)
                .then(() => {
                      flash('User updated Successfully')
                      this.$emit('userUpdated')
                })
                .catch(error => {
                    flash('Something went wrong updating this user')
                    this.editing = true;
                });
            }
          }
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
