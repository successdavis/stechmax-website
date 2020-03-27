@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="container bg-white">
        <div class="section">
            <user-setting :User="{{auth()->user()}}"></user-setting>
        </div>
    </div>
@endsection
