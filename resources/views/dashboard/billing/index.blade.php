@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
	<div class="section">
		@include('dashboard.partials.userBillingStatusCard')
        <user-payments :user="{{auth()->user()}}"></user-payments>
	</div>
@endsection
