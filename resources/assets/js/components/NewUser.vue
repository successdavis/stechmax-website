<template>
    <div>
        <a @click="$modal.show(modal)">Register User</a>

        <modal :name="modal" height="523px" draggable=".window-header">
            <div class="scrollable">                
                <div class="window-header">DRAG ME HERE</div>
                <div slot="top-right">
                    <button @click="$modal.hide(modal)">
                        ❌
                    </button>
                </div>
                <div class="grid-container">
                    <div>
                        <p class="center-text mt-2">USER FORM</p>
                    </div>
                    <div class="grid-x align-center ">
                        <avatar-form :user="user" v-if="update"></avatar-form>
                    </div>

                    <form method="post" @submit.prevent="handleForm" @keydown="Form.errors.clear()">
                            <div class="grid-x grid-padding-x">

                                <div class="medium-6 cell">
                                    <label>Surname Name
                                        <input type="text" v-model="Form.f_name" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('f_name')" v-text="Form.errors.get('f_name')"></p>
                                </div>

                                <div class="medium-6 cell">
                                    <label>Middle Name
                                        <input type="text" v-model="Form.m_name" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('m_name')" v-text="Form.errors.get('m_name')"></p>
                                    
                                </div>

                                <div class="medium-6 cell">
                                    <label>Last Name
                                        <input type="text" v-model="Form.l_name" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('l_name')" v-text="Form.errors.get('l_name')"></p>
                                    
                                </div>

                                <div class="medium-6 cell">
                                    <label>Email Address
                                        <input type="email" v-model="Form.email" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('email')" v-text="Form.errors.get('email')"></p>
                                    
                                </div>

                                <div class="medium-6 cell">
                                    <label>Phone
                                        <input type="text" v-model="Form.phone" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('phone')" v-text="Form.errors.get('phone')"></p>
                                    
                                </div>

                                <div class="medium-6 cell">
                                    <label>Alternative Phone
                                        <input type="text" v-model="Form.alternative_phone" aria-describedby="courseTitleHelpText">
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('alternative_phone')" v-text="Form.errors.get('alternative_phone')"></p>
                                    
                                </div>

                                <div class="medium-6 cell">
                                    <label>Gender
                                        <select v-model="Form.gender" required="">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('gender')" v-text="Form.errors.get('gender')"></p>
                                    
                                </div>

                                <div class="medium-6 cell">
                                    <label>Date of Birth
                                        <input type="date" v-model="Form.dob" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('dob')" v-text="Form.errors.get('dob')"></p>
                                    
                                </div>

                                <div class="cell">
                                    <label>Residential Address
                                        <input type="text" v-model="Form.r_address" aria-describedby="courseTitleHelpText" required>
                                    </label>
                                    <p class="help-text" id="courseTitleHelpText" v-if="Form.errors.has('r_address')" v-text="Form.errors.get('r_addresss')"></p>
                                    
                                </div>

                            </div>
                        <div class="grid-x grid-padding-x mb-2 mt-2">
                            <div class="medium-6">
                                <button :disabled="Form.errors.any()" type="submit" class="expanded medium button success" v-text="update ? 'Update User' : 'Register User'"></button>
                            </div>
                            <div class="medium-6" v-if="update === false">
                                <button type="reset" @click.prevent="reset" class="expanded medium button danger">Reset</button>
                            </div>
                            <div class="medium-6" v-if="update === true">
                                <button type="reset" @click.prevent="reset" class="expanded medium button danger">Register New User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </modal>

    </div>
</template>

<script>
    import avatarForm from './AvatarForm.vue';
    export default {
        props: ['modal'],
        components: {avatarForm},
        data () {
            return {
                update: false,
                user: {},
                Form: new Form({
                    f_name: '',
                    l_name: '',
                    m_name: '',
                    phone: '',
                    alternative_phone: '',
                    email: '',
                    gender: '',
                    dob: '' ,
                    r_address: ''
                })
            }
        },

        methods: {
            handleForm () {
                if (this.update) {
                 return this.updateUser();
                }

                return this.registerUser();
            },

            registerUser () {
                this.Form.post('/register/new_user')
                    .then(data => {
                            // this.Form.reset();
                            this.user = data;
                            this.update = true;
                            flash('New User Created.');
                            Event.$emit('newUserCreated', data);
                        }
                    );
            },

            // '/users/{user}/update'
            updateUser () {
                this.Form.patch(`/users/${this.user.username}/update`)
                    .then(data => {
                            // this.Form.reset();
                            flash('User Update Successfully.');
                        }
                    );
            },

            reset () {
                this.Form.reset();
                this.update = false;
                this.user = {};
            },
        }
    }
</script>
