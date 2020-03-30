@extends('layouts.app')

@section('content')
	@include("courses.partials._courseStreamer")
    
	{{-- Display the course content here --}}
	<div class="container bg-white">
		<div class="columns">
			<div class="column is-6 section">     
				<div class="is-size-4 has-text-centered"><strong>Course Content</strong></div>
			    <ul class="steps is-vertical">
			    	<?php $count = 1 ?>
			    	@foreach ($linked_courses as $linkedcourse)
				      <li class="steps-segment">
				        <span href="#" class="steps-marker">{{$count}}</span>
				        <div class="steps-content">
				          <p class="is-size-4">{{$linkedcourse->title}}</p>
				          <p>{{$linkedcourse->sypnosis}}</p>
				          <a class="button" href="{{$linkedcourse->path()}}">Go to course</a>
				        </div>
				      </li>
				      <?php $count++ ?>
			    	@endforeach

			    </ul>
			</div>
			<div class="column section">	
			    <div class="double-line-height ">
			        <h5 class="is-size-5 mb-2"><strong>What you will learn</strong></h5>
			        <div class="columns is-multiline">
			            @foreach ($course->learns as $learn)
			                <li class="column is-4"><i class="fas fa-plus"></i> {{$learn->body}}</li>
			            @endforeach
			        </div>
			        <hr> 

			        <h5 class="is-size-5 mb-2"><strong>Course Requirement(s)</strong></h5>

			        <div class="columns is-multiline">
			            @foreach ($course->requirements as $requirement)
			                <li class="column is-4">
			                	<i class="fas fa-plus"></i> {{$requirement->body}}
			            	</li>
			            @endforeach
			        </div>
			        <hr>

			        <div class="section">
			            <h5 class="is-size-5 mb-2"><strong>Course Description</strong></h5>
			            <p class="double-line-height">{{$course->description}} </p>
			        </div>
			    </div>
			</div>
		</div>	
	</div>

@endsection
