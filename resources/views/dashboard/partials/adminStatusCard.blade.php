<div class="tile is-ancestor">
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title ">
					<span class="icon"><i class="fas fa-user"></i></span>
					<span><b>{{App\User::totalThisMonth()}} in this Month</b></span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content">
				<div class="level is-mobile">
					<div class="level-item">
						<div class="is-widget-label">
							<h3 class="subtitle is-spaced"> Students </h3>
							<h1 class="title"><div> {{$totalUsers}}</div></h1>
						</div>
					</div>
					<div class="level-item has-widget-icon">
						<div class="is-widget-icon">
							<span class="icon has-text-primary is-large">
								<i class="fas fa-users" style="font-size: 2em"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title">
					<span class="icon"><i class="fas fa-code-branch"></i></i></span>
					<span>{{$totalUsersWithSub}} Users</span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content">
				<div class="level is-mobile">
					<div class="level-item">
						<div class="is-widget-label">
							<h3 class="subtitle is-spaced"> Active Subscription </h3>
							<h1 class="title"><div>{{$countActiveSub}}</div></h1>
						</div>
					</div>
					<div class="level-item has-widget-icon">
						<div class="is-widget-icon">
							<span class="icon has-text-info is-large">
								<i class="fas fa-project-diagram " style="font-size: 2em"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title">
					<span class="icon">
						<i class="fab fa-discourse"></i>
					</span>
					<span><b>{{$yearTotalPay}} this Year</b></span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content">
				<div class="level is-mobile">
					<div class="level-item">
						<div class="is-widget-label">
							<h3 class="subtitle is-spaced">{{date('M')}} Total Income </h3>
							<h1 class="title"><div> N {{$monthlyTotalPay}} </div></h1>
						</div>
					</div>
					<div class="level-item has-widget-icon">
						<div class="is-widget-icon">
							<span class="icon has-text-success is-large">
								<i class="fas fa-window-restore" style="font-size: 2em"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title">
					<span class="icon">
						<i class="fas fa-bell"></i>
					</span><span><b>64</b> in <b>July, 2019</b></span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon">
						<span class="icon"><i class="fas fa-history"></i></span>
					</span>
				</button>
			</header>
			<div class="card-content">
				<div class="level is-mobile">
					<div class="level-item">
						<div class="is-widget-label">
							<h3 class="subtitle is-spaced"> Alerts </h3>
							<h1 class="title"><div> 0 </div></h1>
						</div>
					</div>
					<div class="level-item has-widget-icon">
						<div class="is-widget-icon">
							<span class="icon has-text-danger is-large">
								<i class="fas fa-bell" style="font-size: 2em"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
