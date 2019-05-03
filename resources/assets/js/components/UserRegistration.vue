<template>
    <div>
        <a @click="$modal.show(modal)">Register User</a>

        <modal :name="modal" height="auto" draggable=".window-header">
            <div class="window-header">DRAG ME HERE</div>
            <div slot="top-right">
                <button @click="$modal.hide('foo')">
                    ❌
                </button>
            </div>
            <div class="grid-container">
                <div>
                    <p class="center-text mt-2">USER FORM</p>
                </div>
                <div class="grid-x align-center">
                    <avatar-form :user="user" v-if="showPassport"></avatar-form>
                </div>
                <div class="grid-x grid-padding-x">
                    <div>

                    </div>
                </div>
                <form method="post" @submit.prevent="registerStudent" @keydown="Form.errors.clear()">
                        <div class="grid-x grid-padding-x">

                            <div class="medium-6 cell">
                                <label>Surname Name
                                    <input type="text" v-model="Form.f_name" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Middle Name
                                    <input type="text" v-model="Form.m_name" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Last Name
                                    <input type="text" v-model="Form.l_name" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Email Address
                                    <input type="text" v-model="Form.email" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Phone
                                    <input type="text" v-model="Form.phone" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Alternative Phone
                                    <input type="text" v-model="Form.alternative_phone" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Gender
                                    <select v-model="Form.gender">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="medium-6 cell">
                                <label>Date of Birth
                                    <input type="date" v-model="Form.date" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                            <div class="cell">
                                <label>Residential Address
                                    <input type="text" v-model="Form.r_address" aria-describedby="courseTitleHelpText" required>
                                </label>
                                <p class="help-text" id="courseTitleHelpText"></p>
                            </div>

                        </div>
                    <div class="grid-x grid-padding-x mb-2 mt-2">
                        <div class="medium-6">
                            <button type="submit" class="expanded medium button success" >Register</button>
                        </div>
                        <div class="medium-6">
                            <button type="reset" class="expanded medium button danger">Reset</button>
                        </div>
                    </div>
                </form>

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
                showPassport: false,
                Form: new Form({
                    f_name: '',
                    l_name: '',
                    m_name: '',
                    email: '',
                    phone: '',
                    alternative_phone: '',
                    gender: '',
                    date_of_birth: '',
                    r_address: ''
                })
            }
        },

        methods: {
            registerStudent () {
                this.Form.post('/register/new_user')
                    .then(data => {
                            // this.Form.reset();
                            this.user = data;
                            this.showPassport = true;
                            flash('New User Created.');
                        }
                    );
            },
        }
    }
</script>