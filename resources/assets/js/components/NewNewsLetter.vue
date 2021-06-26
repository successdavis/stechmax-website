<template>
	<div>
		<button class="button" @click="$modal.show('newNewsLetter')">New Newsletter</button>

        <modal name="newNewsLetter" height="auto" draggable=".window-header">
        	<div class="section">
	    			<div class="field">
							<div class="select is-primary">
							  <select v-model="sendTo">
							    <option value="">Send To</option>
							    <option value="user">User</option>
							    <option value="client">Client</option>
							    <option value="employee">Employee</option>
							    <option value="tag">Tag</option>
							    <option value="all">All</option>
							  </select>
							</div>

							<div class="select is-primary">
							  <select>
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
						</div>
						<div class="field">
		        			<b-field label="To">
					            <b-taginput
					                v-model="tags"
					                :data="data"
					                autocomplete
					                :allow-new="allowNew"
					                :open-on-focus="openOnFocus"
					                field="name"
					                icon="label"
					                placeholder="Find a sender"
					                @typing="getData">
					            </b-taginput>
					        </b-field>
						</div>
						<div class="field">
			        		<textarea class="textarea" rows="12"></textarea>
						</div>
        	</div>
        </modal>

	</div>
</template>

<script>
export default {
	data () {
		return {
		 	sendTo: '',
      data: '',
      isSelectOnly: false,
      tags: [],
      allowNew: false,
      openOnFocus: false
    }
	},

	methods: {
        getData(text) {
            axios.get('/getnewsletterrecievers', {
              params: {
                sendTo: this.sendTo,
                search: text,
              },
            }).then((response) => {
              this.data = response.data.data;
            }).catch((error) => {
              flash('Unable to retrieve data at this moment')
            })
        }
    }
}
	
</script>