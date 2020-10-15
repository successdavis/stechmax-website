<clients-datatable inline-template>
	<div class="card has-table has-mobile-sort-spaced">
		<header class="card-header card-cen-v">
			<p class="card-header-title">
				<span class="icon"><i class="fas fa-users"></i></span>
				<span> Clients Record Book</span>
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
							<button @click="sortByColumn('fullname')" class="button" :class="sorttab == 'all' ? 'is-active' : ''">All</button>
							<button @click="sortByColumn('created_at', 'desc')" class="button" :class="sorttab == 'recent' ? 'is-active' : ''">Recent</button>
                            <new-client></new-client>
						</div>
					</div>
				</div>
				<div class="level-right">
					<div class="level-item">
						<form>
							<div class="field has-addons">
								<div class="control">
									<input @keyUp="clientSearch" v-model="search" type="text" placeholder="Name | Phone" class="input">
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
					<div class="table-wrapper has-mobile-cards">
						<table class="table has-mobile-cards is-hoverable">
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
										<div class="th-wrap">Title
											<span class="icon is-small"><i class="fas fa-arrow-up"></i></span>
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
								<tr draggable="false" class="client" v-for="(client, index) in items" :key="client.id">
									<td class="has-no-head-mobile is-image-cell">
										<client-passport :client="client"></client-passport>
									</td>
									<td data-label="Name" class=""
										v-text="client.title "
									></td>
									<td data-label="Name" class=""
										v-text="client.fullname "
									></td>
									<td data-label="Gender" v-text="client.gender" class=""></td>
									<td data-label="Phone" v-text="client.phone" class=""></td>
									<td data-label="Phone" v-text="client.alt_phone" class=""></td>
									<td data-label="User_id" class="">
										<small title="Sep 19, 2018" class="has-text-grey is-abbr-like"
										v-text="client.email"></small>
									</td>
									<td class="is-actions-cell" style="padding-top: 0; min-width: 100px;">
										<div class="buttons is-right">
{{--                                            <span class="icon is-small pointer">--}}
{{--                                                <i class="pointer mdi mdi-pencil"></i>--}}
{{--                                            </span>--}}
                                            <new-client :client="client" umode="edit" :modal="'edit' + index"></new-client>

                                            <optionsbtn position="is-right">
                                                <div>
                                                    <table class="table is-hoverable">
                                                        <tbody>
                                                            <tr class="pointer" @click="deleteClient(client, index)">
                                                                <td><i class="mdi mdi-trash-can"></i></td>
                                                                <td>Delete</td>
                                                            </tr>
                                                            <tr class="pointer">
                                                                <td><i class="mdi mdi-android-messages"></i></td>
                                                                <td>Message</td>
                                                            </tr>
                                                            <tr class="pointer" @click="generatelink(client, index)">
                                                                <td><i class="mdi mdi-file-link"></i></td>
                                                                <td>Generate Link</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </optionsbtn>




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
								<span>Total Users: <span v-text="total"></span></span>
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
</clients-datatable>
