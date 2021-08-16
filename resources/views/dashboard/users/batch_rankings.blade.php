@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
	<div class="container">
		<div class="section">
			<h2 class="has-text-centered is-size-4 mb-2">Students Ranking by Batch</h2>

	        @foreach($users as $month => $user)
	        	<h2 class="title">Batch {{$month}}</h2>
	        		<table class="table is-fullwidth">
	        			<tr>
							<th>Name</th>
							<th>Pos</th>
							<th>Total Points</th>
							<th>This Week</th>
	        			</tr>
			        	@foreach($user as $user)
			        		<tr>
								<td>{{$user->f_name . ' ' . $user->m_name}}</td>
								<td>{{$loop->iteration}}</td>
								<td>{{$user->total_points}}</td>
								<td>{{$user->weekExpTotal()}}</td>
			        		</tr>
			        	@endforeach
		        	</table>
	        @endforeach
		</div>
	</div>
@endsection