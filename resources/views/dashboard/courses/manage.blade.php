@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="mt-3">
    <div class="grid-container">
      <div class="grid-x grid-margin-x">
        <div class="cell medium-3">
          <ul class="vertical tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#target-student" aria-selected="true">Target your students</a></li>
            <li class="tabs-title"><a href="#setup-curriculum">Setup Curriculum</a></li>
            <li class="tabs-title "><a href="#course-landing-page">Course Landing Page</a></li>
            @if ($course->published)
              <a href="/dashboard/{{$course->slug}}/unpublish" class="mt-3 button medium expanded">Unpublish Course</a>
            @else
              <a href="/dashboard/{{$course->slug}}/publish" class="mt-3 button medium expanded">Publish Course</a>
            @endif
          </ul>
        </div>
        <div class="cell medium-9">
          <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="target-student">
                <div class=" grid-container mb-3">
                    <h4>Target Your Audience</h4>
                </div>
                    <hr>
                <target-student :course="{{$course}}"></target-student>
            </div>

            <div class="tabs-panel " id="setup-curriculum">
              <div class="grid-container mb-3">
                <h4>{{$course->type->name }} Curriculum</h4>
              </div>
              <hr>
              @if (strtolower($course->type->name) === 'course')
                <course-curriculum :course="{{$course}}"></course-curriculum>
              @else 
                <track-curriculum :course="{{$course}}"></track-curriculum>
              @endif
            </div>

            <div class="tabs-panel relative-body" id="course-landing-page">
              <div class="grid-container mb-3">
                <h4>Course landing page</h4>
              </div>
              <hr>
              
              <course-landing 
                :course="{{$course}}" 
                :path="'{{$course->path()}}'"
              ></course-landing>
            </div>

            <div class="tabs-panel" id="panel4v">
              <p>Four</p>
              <img class="thumbnail" src="assets/img/generic/rectangle-2.jpg">
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

{{-- 
<li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Target your students</a></li>
                    <li class="tabs-title"><a href="#panel2v">Setup Curriculum</a></li>
                    <li class="tabs-title"><a href="#panel3v">Course Landing Page</a></li>
                    <li class="tabs-title"><a href="#panel4v">Publish Course</a></li> --}}
