<div class="card has-table has-mobile-sort-spaced">
	<header class="card-header card-cen-v">
		<p class="card-header-title">
			<span class="icon"><i class="fas fa-users"></i></span>
			<span> Courses Catalogue</span>
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
						<button class="button">All</button>
						<button class="button">Active</button>
						<button class="button">Disabled</button>
					</div>
				</div>
				<div class="level-item">
					<div class="select">
					  <select>
					    <option>Sort By Subject</option>
					    <option>With options</option>
					  </select>
					</div>
				</div>
			</div>
			<div class="level-right">
				<div class="level-item">
					<form>
						<div class="field has-addons">
							<div class="control">
								<input v-model="search" type="text" placeholder="Name | Id_No | Email" class="input">
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
									<option value="[object Object]">Title</option>
									<option value="[object Object]">Type</option>
									<option value="[object Object]">Duration</option>
									<option value="[object Object]">Fee</option>
									<option value="[object Object]">Status</option>
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
									<div class="th-wrap">Title 
										<span class="icon is-small"><i class="fas fa-arrow-up"></i></span>
									</div>
								</th>
								<th class="is-sortable">
									<div class="th-wrap">Type 
										<span class="icon is-small" style="display: none;">
											<i class="mdi mdi-arrow-up"></i>
										</span>
									</div>
								</th>
								<th class="is-sortable">
									<div class="th-wrap">Duration 
										<span class="icon is-small" style="display: none;">
											<i class="mdi mdi-arrow-up"></i>
										</span>
									</div>
								</th>
								<th class="is-sortable">
									<div class="th-wrap">Fee
										<span class="icon is-small" style="display: none;">
											<i class="mdi mdi-arrow-up"></i>
										</span>
									</div>
								</th>
								<th class="is-sortable">
									<div class="th-wrap">Status
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
							<tr draggable="false" class="" v-for="(course, index) in items">
								<td class="has-no-head-mobile is-image-cell">
									<div class="image">
										<img 
										:src="course.thumbnail_path" 
										class="is-rounded"
										style="width: 24px; height: 24px" 
									>
									</div>
								</td>
								<td data-label="Title" class="" v-text="course.title"></td>
								<td data-label="Type" v-text="course.type" class=""></td>
								<td data-label="Duration" v-text="course.duration + ' weeks'" class=""></td>
								<td data-label="Fee" v-text="course.amount" class=""></td>
								<td data-label="Status" class="">
									<small title="Sep 19, 2018" class="has-text-grey is-abbr-like"
									v-text="course.published"></small>
								</td>
								<td class="is-actions-cell">
									<div class="buttons is-right">
										{{-- <view-user :modal="user.id + 'a'" :selecteduser="user" @userUpdated="fetch"></view-user> --}}
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
				  	{{-- <infinite-loading :identifier="infiniteId" @infinite="fetch"></infinite-loading> --}}
				</div> 
				<div class="level">
					<div class="level-left">
						<div class="level-item">
							<span>Total Courses: <span v-text="total"></span></span>
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