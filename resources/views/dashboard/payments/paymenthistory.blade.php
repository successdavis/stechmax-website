@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="bg-white">   
    <div class="section">
        @foreach($payments as $date => $payment)
        	<h2 class="title">{{$date}}</h2>
        		<table class="table is-fullwidth">
        			<tr>
        				<th>Amount</th>
        				<th>Purpose</th>
        				<th>Paid By</th>
        				<th>Method</th>
        				<th>Ref. No</th>
        			</tr>
		        	@foreach($payment as $transaction)
			        		<tr>
			        			<td>{{str_replace('-', ' ', $transaction->amount / 100)}}</td>
			        			<td>{{$transaction->purpose}}</td>
			        			<td>{{ucwords ($transaction->invoice->owner->f_name . ' ' . $transaction->invoice->owner->f_name)}}</td>
			        			<td>{{$transaction->method}}</td>
			        			<td>{{$transaction->transaction_ref}}</td>
			        		</tr>
		        	@endforeach
	        	</table>
        @endforeach
    </div>
</div>
@endsection