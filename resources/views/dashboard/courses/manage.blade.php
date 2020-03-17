@extends('layouts.app')

@section('content')
<div class="container">
  <div class="section">
    <a class="button" href="/api/courses/viewAllCourses">Return to index</a>
    <tabs :vertical="true">
      <tab name="Target your students" :selected="true">
        <div class="tabs-panel is-active" id="target-student">
            <div class=" grid-container mb-3">
                <h4 class="has-text-centered is-size-4">Target Your Audience</h4>
            </div>
                <hr>
            <target-student :course="{{$course}}"></target-student>
        </div>
      </tab>
      <tab name="Curriculum">
        <div class="grid-container mb-3">
          <h4>{{$course->type->name }} Curriculum</h4>
        </div>
        <hr>
        @if (strtolower($course->type->name) === 'course')
          <course-curriculum :course="{{$course}}"></course-curriculum>
        @else 
          <track-curriculum :course="{{$course}}"></track-curriculum>
        @endif
      </tab>
      <tab name="Landing Page">
        <course-landing 
          :course="{{$course}}" 
          :path="'{{$course->path()}}'"
        ></course-landing>
      </tab>
      <tab name="Visibility">
         @if ($course->published)
          <h3>Unplish {{$course->title}}</h3>
          <p>Are you sure about this? Proceed with caution</p>
          <p>Unpublishing a course will keep it hidden from users</p>
          <a href="/dashboard/{{$course->slug}}/unpublish" class="mt-3 button medium expanded">Unpublish Course</a>
        @else
          <p class="is-size-5">Proceed with Caution!</p>
          <p>Publising a course will make it visible to users and available for subscription, be sure to cross check all aspect of your course before click the button below</p>
          <a href="/dashboard/{{$course->slug}}/publish" class="mt-3 button medium expanded">Publish Course</a>
        @endif
      </tab>
    </tabs>
  </div>
</div>
@endsection
