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
			        <p class="title is-4">{{ucfirst($course->teacher->user->f_name) . ' ' . ucfirst($course->teacher->user->l_name)}}</p>
			        <p class="subtitle is-6">Your Teacher</p>
			      </div>
			    </div>

			    <div class="content">
			      {{$lecture->notes}}
			    </div>
			  </div>
			</div>
			<div>
            @include("courses.partials._coursetableofcontent")
			</div>
		</div>
	</div>
@endsection

