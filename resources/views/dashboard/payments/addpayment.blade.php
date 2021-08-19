@extends('dashboard.partials.dashboardlayout')

@section('head')
 <script src="print.js"></script>
@endsection

@section('dashboardcontent')
    <div class="container bg-white">
        <div class="section">
            <add-payment :user="{{auth()->user()}}"></add-payment>
        </div>
    </div>
@endsection