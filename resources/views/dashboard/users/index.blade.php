@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
	@include('dashboard.users.partials.usersdatatable')
    {{-- <users></users> --}}
@endsection
