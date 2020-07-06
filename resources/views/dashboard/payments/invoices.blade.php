@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="bg-white">   
    <div class="section">
        <manage-invoices :user="{{auth()->user()}}" inline-template>
        	@include('dashboard.payments.partials.invoicesdatatable')
        </manage-invoices>
    </div>
</div>
@endsection
