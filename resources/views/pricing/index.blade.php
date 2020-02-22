@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="section">
			<div class="is-size-4 has-text-centered">Here is a list of services we offer</div>
		</div>

		@foreach ($business as $business)
			<h3>{{$business->name}}</h3>
		@endforeach
	</div>
@endsection