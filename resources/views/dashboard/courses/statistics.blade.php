@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
	<section class="section">
		<div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child">
					<header class="card-header card-cen-v">
						<p class="card-header-title ">
							<span class="icon"><i class="fas fa-user"></i></span>
							<span><b>{{$total}} All Time</b></span>
						</p>
						<button type="button" class="button is-small align-sf-ct">
							<span class="icon"><i class="fas fa-history"></i></span>
						</button>
					</header>
					<div class="card-content">
						<div class="level is-mobile">
							<div class="level-item">
								<div class="is-widget-label">
									<h3 class="subtitle is-spaced"> Active Subscribers </h3>
									<h1 class="title"><div> {{$activeSubscribers}}</div></h1>
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
							<span>All Time Earning</span>
						</p>
						<button type="button" class="button is-small align-sf-ct">
							<span class="icon"><i class="fas fa-history"></i></span>
						</button>
					</header>
					<div class="card-content">
						<div class="level is-mobile">
							<div class="level-item">
								<div class="is-widget-label">
									<h1 class="title"><div> &#8358;{{number_format($totalEarning, 2)}}</div></h1>
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
		</div>
	</section>
	<section class="section">
		<table class="table is-fullwidth">
			<tr>
				<th>Student Name</th>
				<th>Student ID</th>
				<th>Platform</th>
				<th>Status</th>
				<th>Ends At</th>
			</tr>
			@foreach($subscribers as $subscriber)
			<tr>
				<td>{{ucwords($subscriber->owner->f_name . ' ' . $subscriber->owner->l_name)}}</td>
				<td>{{ucwords($subscriber->owner->user_id)}}</td>
				<td>{{$subscriber->platform()}}</td>
				<td>@if($subscriber->status()) active @else inactive @endif</td>
				<td>{{$subscriber->endsAt}}</td>
			</tr>
			@endforeach
		</table>
	</section>
@endsection
