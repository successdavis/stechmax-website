@extends('layouts.app')

@section('pageTitle')
  Services and prices offered at s-techmax
@endsection

@section('content')
	<div class="container">
		<div class="section">
			<div class="is-size-4 has-text-centered">Here is a list of services we offer</div>
		</div>

		<div class="columns is-multiline">
			@foreach ($business as $business)
				<div class="column bg-white is-3">
					<div class="card">
					  <div class="card-image">
					    <figure class="image image is-2by1">
					      <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
					    </figure>
					  </div>
					  <div class="card-content">
				      	<div class="is-size-4">{{$business->name}}</div>
					    <div class="content">
					    </div>
					  </div>
{{-- 					  <footer class="card-footer">
					    <a href="#" class="card-footer-item">Showcase</a>
					    <a href="#" class="card-footer-item">View Prices</a>
					  </footer> --}}
					</div>
					 <div class="card-content">
				  			@foreach ($business->pricing as $price)
				  				<div class="columns is-mobile">
				  					<div class="column is-1"><i class="fas fa-asterisk"></i></div>
					  				<div class="column is-9">{{$price->description}}</div>
					  				<div class="column is-1">{{$price->price}}</div>
				  					
				  				</div>
				  			@endforeach
					 </div>
				</div>
			@endforeach
		</div>
	</div>
@endsection