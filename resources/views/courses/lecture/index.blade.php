@extends('layouts.app')

@section('pageTitle')
  Learn {{$lecture->title}}
@endsection

@section('content')
	<episode :lecture="{{$lecture}}" nextepisode="{{$nextepisode}}" prevepisode="{{$prevepisode}}"></episode>
	<div class="container">
		<div class="section">
			<div class="card">
			  <div class="card-content">
			    <div class="media">
			      <div class="media-left">
			        <figure class="image is-48x48">
			          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
			        </figure>
			      </div>
			      <div class="media-content">
			        <p class="title is-4">John Smith</p>
			        <p class="subtitle is-6">@johnsmith</p>
			      </div>
			    </div>

			    <div class="content">
			      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
			      <a href="#">#css</a> <a href="#">#responsive</a>
			      <br>
			      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
			    </div>
			  </div>
			</div>
		</div>
	</div>
@endsection

