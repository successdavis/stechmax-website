<template>
    <image-carousel :wraparound="false" :autoplay="false" :pageDots="false" :prevNextButtons="true">
           <section class="hero slidebg is-medium" style="width: 100%; height: 400px">
              <div class="hero-body">
                  <div class="container has-text-white has-text-centered">
                      <h1 class="title has-text-white mb-2">
                        Enter Client Full Name
                      </h1>
                        <div class="field input-field">
                          <p class="control has-icons-left has-icons-right">
                            <input v-model="form.fullname" class="input is-large" type="text" placeholder="Success David">
                            <span class="icon is-small is-left">
                              <i class="mdi mdi-account"></i>
                            </span>
                            <span class="icon is-small is-right">
                              <i class="fas fa-check"></i>
                            </span>
                          </p>
                          <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('fullname')" v-text="form.errors.get('fullname')"></p>
                        </div>
                  </div>
              </div>
            </section>
           <section class="hero slidebg is-medium" style="width: 100%; height: 400px">
              <div class="hero-body">
                  <div class="container has-text-centered">
                      <h1 class="title has-text-white mb-2">
                        Select Gender
                      </h1>
                      <div class="flex-center">
                          <div class="control">
                              <label class="radio has-text-white is-size-3">
                                <input v-model="form.gender" type="radio" value="M">
                                Male
                              </label>
                              <label class="radio has-text-white is-size-3">
                                <input v-model="form.gender" type="radio" value="F" checked>
                                Female
                              </label>
                          </div>
                      </div>
                          <p class="help-text has-text-centered" id="genderTitleHelpText" v-if="form.errors.has('gender')" v-text="form.errors.get('gender')"></p>
                  </div>
              </div>
            </section>
           <section class="hero slidebg is-medium" style="width: 100%; height: 400px">
              <div class="hero-body">
                  <div class="container has-text-centered">
                      <h1 class="title has-text-white mb-2">
                        Enter Client Phone Number(s)
                      </h1>
                        <div class="field input-field">
                          <div class="control">
                            <input v-model="form.phone" class="input is-medium" type="text" placeholder="Major Number">
                          </div>
                          <p class="help-text" id="phoneTitleHelpText" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></p>
                        </div>
                        <div class="field input-field">
                          <div class="control">
                            <input v-model="form.alt_phone" class="input is-medium" type="text" placeholder="Alternative Number">
                            <p class="help-text" id="altPhoneTitleHelpText" v-if="form.errors.has('alt_phone')" v-text="form.errors.get('alt_phone')"></p>
                          </div>
                        </div>
                  </div>
              </div>
            </section>
           <section class="hero slidebg is-medium" style="width: 100%; height: 400px">
              <div class="hero-body">
                  <div class="container has-text-centered">
                      <h1 class="title has-text-white mb-2">
                        Enter Client Email
                      </h1>
                        <div class="input-field control has-icons-left has-icons-right">
                          <input v-model="form.email" class="input is-medium" type="email" placeholder="Email">
                          <span class="icon is-left">
                            <i class="fas fa-envelope"></i>
                          </span>
                          <span class="icon is-right">
                            <i class="fas fa-check"></i>
                          </span>
                        </div>
                      <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>
                      <div class="mt-2">
                        <button @click="createUser" :class="processing ? 'is-loading' : '' " class="button is-inverted is-outlined">Create User</button>
                        <button class="button is-primary is-inverted is-outlined">Cancel</button>
                      </div>
                  </div>
              </div>
            </section>
    </image-carousel>

</template>

<script>
    export default {
        data () {
            return {
                open: false,
                processing: false,
                error: '',
                form: new Form({
                    fullname: '',
                    gender: '',
                    phone: '',
                    alt_phone: '',
                    email: '',
                }),
            }
        },

        methods: {
            createUser() {
                this.processing = true;
                this.form.post('api/createclient').then(data => {
                    flash('New User Created.');
                    Event.$emit('newClientCreated', data);
                    this.form.reset();
                    this.processing = false;
                }).catch(error => {
                    flash(error.message,'failed');
                    this.error = error.message;
                    this.processing = false;
                })
            }
        }
    }
</script>
<style scoped>
    .input-field {
        width: 60%;
        margin: auto;
    }
    .flex-center {
        display: flex;
        justify-content: center;
    }

    .slidebg {
        background: #363636;
    }

</style>
