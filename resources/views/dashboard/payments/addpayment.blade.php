@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="container bg-white">
        <div class="section">
            <add-payment :user="{{auth()->user()}}"></add-payment>
        </div>
    </div>
@endsection