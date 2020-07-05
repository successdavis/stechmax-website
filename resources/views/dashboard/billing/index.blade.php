@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
	<div class="section">
		@include('dashboard.partials.userBillingStatusCard')
            <user-payments :user="{{auth()->user()}}"></user-payments>
		
      {{-- @include('dashboard.partials.studentStatusCard') --}}
		
	</div>
    {{-- <billing :user="{{auth()->user()}}"></billing> --}}
@endsection
