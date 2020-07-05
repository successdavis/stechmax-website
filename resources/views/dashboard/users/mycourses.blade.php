@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="section">
        <user-courses :user="{{auth()->user()}}"></user-courses>
    </div>
@endsection
