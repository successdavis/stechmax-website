<users inline-template>
	<div class="card has-table has-mobile-sort-spaced">
		<header class="card-header card-cen-v">
			<p class="card-header-title">
				<span class="icon"><i class="fas fa-users"></i></span>
				<span> Students Record book</span>
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
							<button @click="sortByColumn('f_name')" class="button" :class="sorttab == 'all' ? 'is-active' : ''">All</button>
							<button @click="sortByColumn('created_at', 'desc')" class="button" :class="sorttab == 'recent' ? 'is-active' : ''">Recent</button>
							<button class="button" :class="sorttab == 'passed' ? 'is-active' : ''">No Active Sub</button>
						</div>
					</div>
				</div>
				<div class="level-right">
					<div class="level-item">
						<form>
							<div class="field has-addons">
								<div class="control">
									<input @keyUp="userSearch" v-model="search" type="text" placeholder="Name | Id_No | Email" class="input">
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
										<option value="[object Object]">Date_Joined</option>
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
										<div class="th-wrap">Date_Joined
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>
									<th class="">
										<div class="th-wrap">User_id
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
								<tr draggable="false" class="" v-for="user in items">
									<td class="has-no-head-mobile is-image-cell">
										<a :href="'/profiles/' + user.username">
											<div class="image">
												<img
												:src="user.passport_path"
												class="is-rounded"
												style="width: 24px; height: 24px"
											>
											</div>
										</a>
									</td>
									<td data-label="Name" class=""
										v-text="user.f_name + ' ' + user.m_name + ' ' + user.l_name "
									></td>
									<td data-label="Gender" v-text="user.gender" class=""></td>
									<td data-label="Phone" v-text="user.phone" class=""></td>
									<td data-label="Phone" v-text="user.Date_Joined" class=""></td>
									<td data-label="User_id" class="">
										<small title="Sep 19, 2018" class="has-text-grey is-abbr-like"
										v-text="user.user_id"></small>
									</td>
									<td class="is-actions-cell">
										<div class="buttons is-right">
											<view-user :modal="user.id + 'a'" :selecteduser="user" @userUpdated="fetch"></view-user>
											<button type="button" class="button is-small is-danger">
												<span class="icon is-small">
													<i class="mdi mdi-trash-can"></i>
												</span>
											</button>
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
</users>
