@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="bg-white">   
    <div class="section">
        <manage-invoices :user="{{auth()->user()}}"></manage-invoices>
    </div>
</div>
@endsection
