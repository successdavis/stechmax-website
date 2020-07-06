<div class="card has-table has-mobile-sort-spaced">
	<header class="card-header card-cen-v">
		<p class="card-header-title">
			<span class="icon"><i class="mdi mdi-cash-multiple"></i></span>
			<span> Invoices Registry</span>
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
						<button class="button">Completed</button>
						<button class="button">Incompleted</button>
					</div>
				</div>
				<div class="level-item">
					<div class="select">
					  <select v-model="perPage" @change="fetch">
					    <option value="">Rows Per Page</option>
					    <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="all">All</option>
					  </select>
					</div>
				</div>
			</div>
			<div class="level-right">
				<div class="level-item">
					<form>
						<div class="field has-addons">
							<div class="control">
								<input type="text" placeholder="Invoice No." class="input">
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
									<option value="[object Object]">Date</option>
									<option value="[object Object]">InvoiceNo</option>
									<option value="[object Object]">BilledTo</option>
									<option value="[object Object]">Amount</option>
									<option value="[object Object]">Status</option>
									<option value="[object Object]">Action</option>
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
						{{-- <thead>
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
						</thead> --}}
						<thead>
				            <tr>
				            	<th v-for="t_head in headers" class="is-current-sort is-sortable">
									<div class="th-wrap"><span v-text="t_head.name"></span> 
										<span v-if="t_head.name === 'Name'" class="icon is-small" @click.prevent="sortByColumn(t_head.sort)">
											<i v-if="order === 'asc' " class="mdi mdi-arrow-up"></i>
				                            <i v-else class="mdi mdi-arrow-down"></i>
										</span>
									</div>
								</th>
				            </tr>
				        </thead>
						<tbody>
				            <tr v-for="data in invoices" :key="data.id">
				                <td v-text="data.date">
				                </td>
				                <td data-label="Invoice No" v-text="data.invoiceNo"></td>
				                <td data-label="BilledTo" v-text="data.billedTo.f_name + ' ' + data.billedTo.l_name"></td>
				                <td data-label="Amount" v-text="data.amount"></td>
				                <td data-label="Status" v-text="data.status"></td>

				                <td class="is-actions-cell">
									<div class="buttons is-right">
										<a title="View Payments" type="button" class="button is-small is-danger">
											<span class="icon is-small">
												<i class="mdi mdi-eye"></i>
											</span>
										</a>
										<invoice-payments :modal="data.id + 'a'" :selectedinvoice="data"></invoice-payments>
									</div>
								</td> 
				            </tr>
				        </tbody>
					</table>
				</div> 
				<div class="level">
					<div class="level-left">
						<div class="level-item">
							<span>Total Invoices: <span v-text="dataSet.total"></span></span>
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