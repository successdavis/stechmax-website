<template>
	<div>

		<button class="button is-primary is-small" @click="$modal.show('position')">Manage Position</button>
		<modal name="position"> 
			<div class="section">
				<form>
					<div class="control">
					  <div class="select is-fullwidth mb-2">
					    <select v-model="Form.department">
					      <option selected disabled value="">Select a Department</option>
					      <option v-for="department in departments" :value="department">{{department.name}}</option>
					    </select>
					  </div>
					</div>

					<div class="control">
					  <div class="select is-fullwidth mb-2">
					    <select v-model="Form.role" @change="getPaygrades">
					      <option selected disabled="true" value="">Select a Job Title (Roles)</option>
					      <option value="">None</option>
					      <option v-for="role in roles" :value="role">{{role.name}}</option>
					    </select>
					  </div>
					</div>

					<div class="control">
					  <div class="select is-fullwidth mb-2">
					    <select v-model="Form.paygrade">
					      <option value="">Paygrade (Level)</option>
					      <option v-for="paygrade in paygrades" :value="paygrade">{{paygrade.name}}</option>
					    </select>
					  </div>
					</div>
				</form>

				<button :class="isLoading ? 'is-loading' : '' " class="button is-primary" @click="adjustPosition">Adjust Position</button>
			</div>
		</modal>
	</div>
	
</template>

<script>
	export default {
		props: ['employee'],

		data () {
			return {
				isLoading: false,
				departments: [],
				paygrades: [],

				Form: new Form({
					department: '',
					role: '',
					paygrade: '',
				}),
			}
		},

		computed: {

			roles () {
				return this.Form.department.roles;
			}
		},

		created () {
			axios.get('/departments')
			.then((response) => {
			  this.departments = response.data
			}).catch((error) => {
			  flash('System was unable to retrieve departments');
			})
		},

		methods: {
			getPaygrades (role) {
				axios.get(`/${this.Form.role.id}/paygrades`)
				.then((response) => {
				  this.paygrades = response.data;
				}).catch((error) => {
				  console.error(error);
				})
			},

			adjustPosition () {
				this.isLoading = true;
				this.Form.post(`/${this.employee.user_id}/adjustposition`)
				.then((response) => {
					flash('Position Updated')
					this.isLoading = false;
				})
				.catch((error) => {
					flash('Something went wrong, contact support', 'failed')
					this.isLoading = false;
				})
			}
		}
	}
</script>