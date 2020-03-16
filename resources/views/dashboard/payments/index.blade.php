@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="grid-container mt-2">
        <div class="bg-white">
            <user-payments :user="{{auth()->user()}}"></user-payments>
        </div>
    </div>
@endsection
