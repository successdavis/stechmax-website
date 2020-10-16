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
					<span><b>&#8358;{{$yearTotalPay}} this Year</b></span>
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
							<h1 class="title"><div> &#8358;{{$monthlyTotalPay}} </div></h1>
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

<div class="tile is-ancestor">
	<div class="tile is-parent" >
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title ">
					<span class="icon"><i class="mdi mdi-history"></i></span>
					<span>Activity History</b></span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content" style="max-height: 400px; overflow-y: scroll">
                    @forelse ($adminActivities as $date => $activity)
                        <h4><strong>{{ $date }}</strong></h4>
                        <table class="table is-striped is-fullwidth">
                            @foreach ($activity as $record)
                                <tr>
                                    @if (view()->exists("dashboard.activities.{$record->type}"))
                                        @include ("dashboard.activities.{$record->type}", ['activity' => $record])
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                        <hr>
                    @empty
                        <p>There is no activity for you yet</p>
                    @endforelse
			</div>
		</div>
	</div>
{{--    Latest Students Record--}}
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title">
					<span class="icon"><i class="mdi mdi-account-heart"></i></i></span>
					<span>Most Recent Users</span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content" style="max-height: 400px; overflow-y: auto">
				<table class="table is-fullwidth">
                    <tbody>
                        @foreach($mostRecentUsers as $user)
                            <tr>
                                <td class="has-no-head-mobile is-image-cell">
                                    <div class="image">
                                        <img
                                        src="{{$user->passport_path}}"
                                        class="is-rounded"
                                        style="width: 24px; height: 24px"
                                    >
                                    </div>
                                </td>
                                <td>{{$user->f_name}} {{$user->m_name}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td><a href="/users/generatecmdcard/{{$user->username}}">PMT</a></td>
{{--                                :href="'/users/generatecmdcard/' + username">PMT CARD--}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
<div class="tile is-ancestor">

{{--    Display list of recent messages --}}
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title">
					<span class="icon"><i class="mdi mdi-email"></i></i></span>
					<span>Messages</span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content" style="max-height: 400px; overflow-y: auto">
                @foreach($messages as $message)
                    <message :message="{{$message}}"></message>
                @endforeach

			</div>
		</div>
	</div>
</div>
