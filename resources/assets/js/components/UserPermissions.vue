<template>
	<div>
		<h2 class="is-size-2">Permissions</h2>

		 <b-table 
            :data="userpermissions">

            <template slot-scope="props">
                <b-table-column field="name" label="Name" width="40" sortable numeric>
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column field="gender" label="Action">
                    <a @click="revokePermission(props.row)" class="button small is-danger">Revoke Permission</a>
                </b-table-column>
            </template>
        </b-table>

		<button class="button is-primary" @click="$modal.show('permissions')">Add Permissions</button>
		<modal name="permissions"> 
			<div>
				 <b-table 
		            :data="unsyncpermissions">

		            <template slot-scope="props">
		                <b-table-column field="name" label="Name" width="40" sortable numeric>
		                    {{ props.row.name }}
		                </b-table-column>

		                <b-table-column field="gender" label="Action">
		                    <a @click="givePermission(props.row)" class="button small is-info">Give Permission</a>
		                </b-table-column>
		            </template>
		        </b-table>
			</div>
		</modal>
	</div>
	
</template>

<script>
	export default {
		props: ['user'],

		data () {
			return {
				permissions: [],
				userpermissions: [],
			}
		},

		computed: {
			unsyncpermissions () {
				if (this.permissions) {
					return this.permissions.filter((el) => { 
						return !this.userpermissions.map((sel) => { return sel.id }).includes(el.id) 
					})
				}
			}
		},

		created () {
			axios.get(`/userpermissions/${this.user.username}`)
			.then((response) => {
			  this.userpermissions = response.data
			  console.log(response.data);
			}).catch((error) => {
			  flash('System was unable to retrieve permissions for user');
			})

			axios.get('/permissions')
			.then((response) => {
			  this.permissions = response.data;
			}).catch((error) => {
			  console.error(error);
			})
		},

		methods: {
			givePermission(row){
				axios.post(`/givepermission/${row.id}/${this.user.username}`)
				.then((response) => {
				  flash('Permission granded');
				  this.userpermissions.push(row)
				}).catch((error) => {
				  flash('System Error', 'error');
				})
			},

			revokePermission(row) {
				axios.post(`/revokepermission/${row.id}/${this.user.username}`)
				.then((response) => {
				  flash('Permission removed from user')
				  this.userpermissions.splice(row, 1)
				}).catch((error) => {
				  flash('Something went wrong','failed')
				})
			}
		}
	}
</script>