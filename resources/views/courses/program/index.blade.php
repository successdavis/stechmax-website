@extends('layouts.app')

@section('content')
<div >
   @include('courses.program.partials.streamer')

   @include('courses.program.partials.lower-nav')

   <div class="container" id="overview">
      <div class="columns">
         <div class="column" >
            @include('courses.program.partials.details')
         </div>
         <div class="column is-3">
            @include('courses.program.partials.aside')
         </div>
      </div>
   </div>

   <div class="program-course-curriculum" id="curriculum">
      <div class="container">
         <h2 class="center-text">Program Curriculum</h2>
         <hr>
         <div class="columns grid-padding-x mb-3">
            @foreach ($linked_courses as $curriculum)
               @include('courses.program.partials.course')
            @endforeach

         </div>
      </div>
   </div>
</div>
@endsection

