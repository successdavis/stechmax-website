<template>
    <div class="contact-form" id="contact-form">
        <div class="section contact-form_form">
            <div class="field">
              <label class="label">Full Name</label>
              <div class="control">
                <input v-model="fullname" class="input is-medium" type="text" placeholder="Text input">
              </div>
            </div>

            <div class="field">
              <label class="label">Email</label>
              <div class="control has-icons-left has-icons-right">
                <input v-model="email" class="is-medium input" type="email" placeholder="Email input" >
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
              </div>
    <!--          <p class="help is-danger">This email is invalid</p>-->
            </div>

            <div class="field">
              <label class="label">Message</label>
              <div class="control">
                <textarea v-model="message" rows="10" class="textarea" placeholder="Textarea"></textarea>
              </div>
            </div>

            <div class="field is-grouped">
              <div class="control">
                <button class="button is-link is-large" @click="sendmessage">Submit</button>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                fullname: '',
                email: '',
                message: '',
            }
        },

        methods: {
            sendmessage(){
                console.log('sending');
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
</style>
