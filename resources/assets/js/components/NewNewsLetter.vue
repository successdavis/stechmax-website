<template>
	<div>
		<button class="button" @click="$modal.show('newNewsLetter')">New Newsletter</button>

        <modal name="newNewsLetter" height="auto" draggable=".window-header" :clickToClose="false" :adaptive="true" :scrollable="true">
        	<div class="section">
	    			<div class="field">
							<div class="select is-primary">

							  <select @change="reset" v-model="Form.sendTo">
							    <option value="">Send To</option>
							    <option value="user">User</option>
							    <option value="client">Client</option>
							    <option value="employee">Employee</option>
							    <option value="tag">Tag</option>
							    <option value="all">All</option>
							  </select>
							</div>

							<div class="select is-primary">
							  <select v-model="Form.category">
							    <option value="">Category</option>
							    <option value="promotion">Promotion</option>
							    <option value="followup">Followup</option>
							    <option value="update">Update</option>
							    <option value="job application">Job Application</option>
							    <option value="offer">Offer</option>
							    <option value="coupon">Coupon</option>
							    <option value="sales">Sales</option>
							  </select>
							</div>
							<span>
								<label class="checkbox">
								  <input type="checkbox" v-model="Form.sendtoall">
								  Send to All
								</label>
							</span>
						</div>
						<div class="field">
							<div class="control">
								<input class="input is-rounded" v-model="Form.subject" type="text" placeholder="Subject">
							</div>
						</div>
						<div class="field" v-show="Form.sendtoall === false">
		        			<b-field label="">
					            <b-taginput
					                v-model="Form.tags"
					                :data="filteredData"
					                autocomplete
					                :allow-new="allowNew"
					                :open-on-focus="openOnFocus"
					                field="name"
					                icon="label"
					                placeholder="Find a sender"
					                @typing="getData">
					                <template #empty>
					                    There are no items
					                </template>
					            </b-taginput>
					        </b-field>
						</div>
						<div class="field">
			        		<textarea v-model="Form.body" class="textarea" rows="12"></textarea>
						</div>
						<div class="footer">
							<button class="button" @click="sendNewsLetter" :class="processing ? 'is-loading' : '' ">Send Newsletter</button>							
							<button v-show="!processing" class="button is-danger" @click="$modal.hide('newNewsLetter')">Cancel</button>							
						</div>
        	</div>
        </modal>

	</div>
</template>

<script>
export default {
	data () {
		return {
      data: '',
      processing: false,
      isSelectOnly: false,
      allowNew: false,
      openOnFocus: false,
      Form: new Form({
	      tags: [],
			 	sendTo: '',
      	body: '',
      	category: '',
      	subject: '',
      	sendtoall: false,
      })
    }
	},

	computed: {
		filteredData () {
			if (this.data) {
				return this.data.filter((el) => { 
					return !this.Form.tags.map((sel) => { return sel.id }).includes(el.id) 
				})
			}
		}
	},

	methods: {
        getData(text) {
            axios.get('/getnewsletterrecievers', {
              params: {
                sendTo: this.Form.sendTo,
                search: text,
              },
            }).then((response) => {
              this.data = response.data.data;
            }).catch((error) => {
              flash('Unable to retrieve data at this moment','failed')
            })
        },

        sendNewsLetter() {
        	this.processing = true;
        	this.Form.post('/sendnewsletter')
        	.then((data) => {
	        	this.processing = false;
        		flash('Newsletter Dispatched');

        	})
        	.catch((e) => {
	        	this.processing = false;
        		flash(e.message, 'failed');
        	})
        },

        reset() {
        	this.Form.tags = [];

        	console.log(this.Form.tags);
        }
    }
}
	
</script>