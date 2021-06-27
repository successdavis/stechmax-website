<template>
	<section>
		 <b-field label="Tags">
            <b-taginput
                v-model="tags"
                :data="filteredData"
                autocomplete
                :allow-new="allowNew"
                :open-on-focus="openOnFocus"
                field="tag"
                icon="label"
                placeholder="Add a tag"
                @add="addTag"
                @remove="removeTag"
                @typing="getTags">
            </b-taginput>
        </b-field>
	</section>
</template>

<script>
    export default {
    	props: ['model_type', 'model_id'],

        data() {
            return {
            	data: [],
                isSelectOnly: false,
                tags: [],
                allowNew: true,
                openOnFocus: false
            }
        },

		computed: {
			filteredData () {
				if (this.data) {
					return this.data.filter((el) => { 
						return !this.tags.map((sel) => { return sel.id }).includes(el.id) 
					})
				}
			}
		},

		mounted() {
			axios.get('getsynctags', {
			  params: {
			    model_id: this.model_id,
			    model_type: this.model_type,
			  },
			}).then((response) => {
			  this.tags = response.data;
			}).catch((error) => {
			  console.error(error);
			})
		},

        methods: {
        	getTags(text) {
        		if (text.length < 2) {
        			return;
        		}
                axios.get('/tags', {
                  params: {
                    search: text,
                  },
                }).then((response) => {
                  this.data = response.data;
                }).catch((error) => {
                  console.log('something went wrong')
                })
	        },

	        addTag(tag) {
	        	axios.post('/addtag', {
	        	  tag: tag,
	        	  model_id: this.model_id,
	        	  model_type: this.model_type,
	        	}).then((response) => {
	        	  console.log('tag added')
	        	}).catch((error) => {
	        	  console.error(error);
	        	})
	        },

	        removeTag(tag) {
	        	axios.post('/detachtag', {
        			tag: tag,
	        	  	model_id: this.model_id,
	        	  	model_type: this.model_type,
	        	}).then((response) => {
	        	  this.tags.splice(indexOf(tag), 1);
	        	}).catch((error) => {
	        	  console.error(error);
	        	})
	        }
	    }
    }
</script>
