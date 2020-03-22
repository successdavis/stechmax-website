@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
	<div class="container">
		<div class="section">
			<h2 class="has-text-centered is-size-4 mb-2">Top 20 Students</h2>
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>Pos</th>
						<th>Name</th>
						<th>Points</th>
					</tr>
				</thead>
				<tbody>	
					@foreach ($users as $user)
						<tr>	
							<td>{{$loop->iteration}}</td>
							<td>{{$user->f_name . ' ' . $user->m_name}}</td>
							<td>{{$user->points}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection