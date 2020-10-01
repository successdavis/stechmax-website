<clientsdatatable inline-template>
	<div class="card has-table has-mobile-sort-spaced">
		<header class="card-header card-cen-v">
			<p class="card-header-title">
				<span class="icon"><i class="fas fa-users"></i></span>
				<span> Clients Datatable</span>
			</p>
			<button type="button" class="button is-small align-sf-ct">
				<span class="icon"><i class="mdi mdi-refresh default"></i></span>
				<span>Refresh</span>
			</button>
		</header>
		<div class="notification is-card-toolbar">
			<div class="level">
				<div class="level-left">
					<div class="level-item">
						<div class="buttons has-addons">
							<button @click="sortByColumn('username')" class="button" :class="sorttab == 'all' ? 'is-active' : ''">All</button>
							<button @click="sortByColumn('created_at', 'desc')" class="button" :class="sorttab == 'recent' ? 'is-active' : ''">Recent</button>
							<button @click="addingClient = !addingClient" class="button is-primary">New Client</button>
						</div>
					</div>
				</div>
				<div class="level-right">
					<div class="level-item">
						<form>
							<div class="field has-addons">
								<div class="control">
									<input @keyUp="clientSearch" v-model="search" type="text" placeholder="Name | Phone | Email" class="input">
								</div>
								<div class="control">
									<button type="submit" class="button is-primary" :class="isLoading ? 'is-loading' : '' ">
										<span class="icon"><i class="fas fa-search"></i></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        <new-client v-if="addingClient"></new-client>
		<div class="card-content">
			<div>
				<!---->
				<div class="b-table">
					<div class="field table-mobile-sort">
						<div class="field has-addons">
							<div class="control is-expanded">
								<span class="select is-fullwidth">
									<select>
										<!----> <!----> <!---->
										<option value="[object Object]">Name</option>
										<option value="[object Object]">Gender</option>
										<option value="[object Object]">Phone</option>
										<option value="[object Object]">Alt Phone</option>
										<option value="[object Object]">Email</option>
										<!----><!---->
									</select>
								</span> <!---->
							</div>
							<div class="control">
								<button class="button is-primary">
									<span class="icon is-small"><i class="fas fa-arrow-up"></i></span>
								</button>
							</div>
						</div>
					</div>
					<!---->
					<div class="table-wrapper">
						<table class="table is-striped has-mobile-cards is-hoverable">
							<thead>
								<tr>
									<th class="">
										<div class="th-wrap">
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
									<th class="is-current-sort is-sortable">
										<div class="th-wrap">Name
											<span class="icon is-small"><i class="fas fa-arrow-up"></i></span>
										</div>
									</th>
									<th class="is-sortable">
										<div class="th-wrap">Gender
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
									<th class="is-sortable">
										<div class="th-wrap">Phone
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
									<th class="is-sortable">
										<div class="th-wrap">Alt Phone
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
									<th class="">
										<div class="th-wrap">Email
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
									<th class="">
										<div class="th-wrap">
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr draggable="false" class="" v-for="client in items">
									<td class="has-no-head-mobile is-image-cell">
                                        <div class="image">
                                            <client-passport :client="client"></client-passport>


                                        </div>
									</td>
									<td data-label="Name" class=""
										v-text="client.fullname"
									></td>
									<td data-label="Gender" v-text="client.gender" class=""></td>
									<td data-label="Phone" v-text="client.phone" class=""></td>
									<td data-label="Phone" v-text="client.alt_phone" class=""></td>
									<td data-label="Phone" v-text="client.email" class=""></td>

									<td class="is-actions-cell">
										<div class="buttons is-right">

										</div>
									</td>
								</tr>
							</tbody>
						</table>
					  	<infinite-loading :identifier="infiniteId" @infinite="fetch"></infinite-loading>
					</div>
					<div class="level">
						<div class="level-left">
							<div class="level-item">
								<span>Total Clients: <span v-text="total"></span></span>
							</div>
						</div>
						<div class="level-right">
							<div class="level-item">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</clientsdatatable>
