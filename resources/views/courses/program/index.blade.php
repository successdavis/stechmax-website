@extends('layouts.app')

@section('content')
<div >
   @include('courses.program.partials.streamer')

   @include('courses.program.partials.lower-nav')

   <div class="grid-container" id="overview">
      <div class="grid-x grid-padding-x">
         <div class="medium-8 cell " >
            @include('courses.program.partials.details')
         </div>
         <div class="medium-4 cell">
            @include('courses.program.partials.aside')
         </div>
      </div>
   </div>

   <div class="program-course-curriculum" id="curriculum">
      <div class="grid-container">
         <h2 class="center-text">Program Curriculum</h2>
         <hr>
         <div class="grid-x grid-padding-x mb-3">
            @foreach ($course->childrenCourses as $curriculum)
               @include('courses.program.partials.course')
            @endforeach

         </div>
      </div>
   </div>
</div>
@endsection

