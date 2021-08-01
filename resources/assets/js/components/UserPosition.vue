<template>
	<div>

		<button class="button is-primary is-small" @click="$modal.show('position')">Manage Position</button>
		<modal name="position"> 
			<div class="section">
				<form>
					<div class="control">
					  <div class="select is-fullwidth mb-2">
					    <select>
					      <option>Department</option>
					      <option>With options</option>
					    </select>
					  </div>
					</div>

					<div class="control">
					  <div class="select is-fullwidth mb-2">
					    <select>
					      <option>Job Title (Roles)</option>
					      <option>With options</option>
					    </select>
					  </div>
					</div>

					<div class="control">
					  <div class="select is-fullwidth mb-2">
					    <select>
					      <option>Paygrade (Level)</option>
					      <option>With options</option>
					    </select>
					  </div>
					</div>
				</form>

				<button class="button is-primary">Adjust Position</button>
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
			axios.get('/departments')
			.then((response) => {
			  this.departments = response.data
			}).catch((error) => {
			  flash('System was unable to retrieve departments');
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