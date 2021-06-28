@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="bg-white">   
    <div class="section">
		<table class="table is-fullwidth">
	        @foreach($payments as $date => $amount)
	        	<tr>
        			<td>{{date("F", mktime(0, 0, 0, $date, 1))}}</td>
        			<td>{{str_replace('-', ' ', $amount / 100)}}</td>
        		</tr>
	        @endforeach
    	</table>
    </div>
</div>
@endsection