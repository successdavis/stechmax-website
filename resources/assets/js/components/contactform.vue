<template>
    <div class="contact-form" id="contact-form">
        <div v-if="sent" :class="sent ? '' : 'disappear' ">
            <div class="section">
                <p class="title">Thank you. We acknowledge receipt of your message You'll hear from us shortly</p>
            </div>
        </div>
        <div :class="sent ? 'disappear' : '' "  class="section contact-form_form">
            <div class="field">
              <label class="label">Full Name</label>
              <div class="control">
                <input v-model="form.fullname" class="input is-medium" type="text">
              </div>
              <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('fullname')" v-text="form.errors.get('fullname')"></p>
            </div>

            <div class="field">
              <label class="label">Phone</label>
              <div class="control has-icons-left has-icons-right">
                <input v-model="form.phone" class="is-medium input" type="email" placeholder="Optional" >
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
              </div>
            <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></p>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control has-icons-left has-icons-right">
                    <input v-model="form.email" class="is-medium input" type="email" >
                    <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
                </div>
            <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>
            </div>


            <div class="field">
              <label class="label">Message</label>
              <div class="control">
                <textarea v-model="form.message" rows="10" class="textarea" placeholder="Textarea"></textarea>
                  <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('message')" v-text="form.errors.get('message')"></p>
              </div>
            </div>

            <div class="field is-grouped">
              <div class="control">
                <button :class="processing ? 'is-loading' : ''" class="button is-link is-large" @click="send">Submit</button>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                sent: false,
                processing: false,
                form: new Form({
                    fullname: '',
                    email: '',
                    phone: '',
                    message: '',
                }),
            }
        },

        methods: {
            send(){
                this.processing = true;
                this.form.post('/send-a-message')
                .then(() => {
                    flash('Thank you!');
                    this.sent = true;
                    this.processing = false;
                })
                .catch(() => {
                    this.processing = false;
                    flash('Your message cannot be sent at the moment, please try again', 'failed');
                })
            }
        }
    }
</script>
<style scoped>
    .contact-form{
        display: flex;
        justify-content: center;
    }

    .contact-form_form {
        max-width: 50%;
        width: 100%;
    }

    .disappear {
        opacity: 0;
    }
</style>
