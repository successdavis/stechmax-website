<template>
    <div>
        <button v-if="mode == 'create'" @click="$modal.show(modal)" class="button">New Client</button>
        <span v-if="mode == 'edit' " @click="$modal.show(modal)" class="icon is-small pointer"><i class="pointer mdi mdi-pencil"></i></span>

        <modal :name="modal" height="auto" draggable=".window-header" :clickToClose="false" :adaptive="true" :scrollable="true">
                <div class="new-client-header pd">
                     <h4>Create New Client </h4>
                </div>
                <hr style="margin: 0">
            <div class="pd">
                    <div class="field is-horizontal is-flex flex-v-center">
                      <div class="field-label is-normal mt-reset pt-reset is-flex flex-center">
                          <figure class="image is-48x48">
                          <img class="is-rounded" src="https://bulma.io/images/placeholders/256x256.png">
                        </figure>
                      </div>
                      <div class="field-body">
                        <div class="field is-narrow">
                          <div class="control">
                            <div class="select">
                              <select v-model="form.title">
                                <option disabled value="">Title</option>
                                <option v-for="title in titles" v-text="title"></option>
                              </select>
                            </div>
                            <div class="select">
                              <select v-model="form.gender">
                                <option disabled value="">Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="field is-horizontal is-flex flex-v-center">
                      <div class="field-label is-normal mt-reset pt-reset is-flex flex-center">
                        <span>
                            <i class="mdi mdi-account"></i>
                        </span>
                      </div>
                      <div class="field-body">
                        <div class="field">
                          <p class="control is-expanded has-icons-left">
                            <input v-model="form.fullname" class="input" type="text" placeholder="Fullname">
                          </p>
                        </div>
                      <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('fullname')" v-text="form.errors.get('fullname')"></p>
                      </div>
                    </div>

                    <div class="field is-horizontal is-flex flex-v-center">
                      <div class="field-label is-normal mt-reset pt-reset is-flex flex-center">
                          <i class="mdi mdi-phone"></i>
                      </div>
                      <div class="field-body">
                        <div class="field is-expanded">
                          <div class="field has-addons">
                            <p class="control">
                              <a class="button is-static">
                                NIG
                              </a>
                            </p>
                            <p class="control is-expanded">
                              <input v-model="form.phone" class="input" type="tel" placeholder="Your phone number">
                            </p>
                            <p class="control is-expanded">
                              <input class="input" v-model="form.alt_phone" type="tel" placeholder="Alt phone number">
                            </p>
                          </div>
                          <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></p>
                          <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('alt_phone')" v-text="form.errors.get('alt_phone')"></p>
                        </div>
                      </div>
                    </div>
                    <div class="field is-horizontal is-flex flex-v-center">
                      <div class="field-label is-normal mt-reset pt-reset is-flex flex-center">
<!--                        <label class="label">Note</label>-->
                          <i class="mdi mdi-email"></i>
                      </div>
                        <div class="field-body">
                        <div class="field is-expanded">
                          <div class="field has-addons">
                            <p class="control is-expanded">
                              <input class="input" type="email" v-model="form.email" placeholder="Your Email Address">
                            </p>
                          </div>
                          <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>
                        </div>
                      </div>
                    </div>

                    <div class="field is-horizontal">
                      <div class="field-label is-normal mt-reset pt-reset is-flex flex-center">
<!--                        <label class="label">Note</label>-->
                          <i class="mdi mdi-microsoft-onenote"></i>
                      </div>
                      <div class="field-body">
                        <div class="field">
                          <div class="control">
                            <textarea class="textarea" v-model="form.note" placeholder="Explain how we can help you"></textarea>
                          </div>
                        </div>
                        <p class="help-text" id="courseTitleHelpText" v-if="form.errors.has('note')" v-text="form.errors.get('note')"></p>
                      </div>
                    </div>

                    <div class="field mb-1">
                      <div v-if="mode === 'edit'">
                        <tags :model_id="client.id" model_type="Client"></tags>
                      </div>                      
                    </div>


                    <div class="field is-horizontal">
                      <div class="field-label mt-reset pt-reset is-flex flex-center">
                        <!-- Left empty for spacing -->
                      </div>
                      <div class="field-body">
                        <div class="field">
                          <div class="control">
                            <button :class="processing ? 'is-loading' : '' " @click="createUser" class="button is-primary">
                              Save
                            </button>
                            <button @click="$modal.hide(modal)" class="button is-primary is-outlined">
                              Cancel
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
        </modal>
    </div>

</template>

<script>
  import tags from '../components/tags';
    export default {
        components: {tags},
        props: {
            umode: {
                default: 'create'
            },
            client: {
                required: false
            },
            modal: {
                default: 'newClient'
            }

        },
        data () {
            return {
                open: false,
                mode: this.umode,
                processing: false,
                error: '',
                titles: ['Mr.', 'Dr.','Bar.','Mrs.','Miss','Master','Sir','Prof','Rev.'],
                form: new Form({
                    title: this.client ? this.client.title : '',
                    fullname: this.client ? this.client.fullname : '',
                    gender: this.client ? this.client.gender : '',
                    phone: this.client ? this.client.phone : '',
                    alt_phone: this.client ? this.client.alt_phone : '',
                    email: this.client ? this.client.email : '',
                    note: this.client ? this.client.note : '',
                }),
            }
        },

        methods: {
            createUser() {

                this.mode == 'edit' ? this.update() : this.post();
            },

            post () {
                this.processing = true;
                this.form.post('api/createclient').then(data => {
                    flash('New User Created.');
                    Event.$emit('newClientCreated', data);
                    this.form.reset();
                    this.processing = false;
                    this.$modal.hide('newClient');
                }).catch(error => {
                    flash(error.message,'failed');
                    this.error = error.message;
                    this.processing = false;
                })
            },
            update () {
                this.processing = true;
                this.form.patch(`api/updateclient/${this.client.id}`).then(data => {
                    flash('User updated.');
                    Event.$emit('clientupdated', data);
                    this.processing = false;
                    this.$modal.hide('newClient');
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
    .new-client-header {
        color: black;
        letter-spacing: .00625em;
        font-weight: 500;
        line-height: 1.5rem;
        font-family: 'Google Sans',Roboto,Arial,sans-serif;
    }
    .pd {
        padding: 1rem 1.5rem;
    }
    .flex-center {
        justify-content: center;
    }

    .flex-v-center {
        align-items: center;
    }
    i {
        font-size: 1.5em;
        color: #aeaeaf;
    }

    .field.is-horizontal.is-flex.flex-v-center.mb-reset {
        margin-bottom: 0;
    }
</style>
