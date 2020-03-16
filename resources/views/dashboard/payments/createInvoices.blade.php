@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
    <div class="section">
        <create-invoices :user="{{auth()->user()}}"></create-invoices>
    </div>
@endsection