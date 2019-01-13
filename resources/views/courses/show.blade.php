@extends('layouts.app')

@section('content')
<div class="course-big-banner">
    <div id="grid-container">
        <div class="course-big-banner--content grid-container">
            <h2>{{$course->title}}</h2>
            <div class="grid-x grid-padding-x">
                <div class="medium-6">
                    <div class="grid-container">
                        <div>Study remotely at the comfort of your home with a smart phone or PC, One-on-One with your tutor</div>
                        <a href="{{$course->path()}}/plans" class="medium button">STUDY ONLINE</a>
                    </div>
                </div>
                <div class="medium-6">
                    <div class="grid-container">
                        <div>Study online and also share physical interactions with tutors at the esteemed institute.</div>
                        <a href="{{$course->path()}}/plans/classroom" class="medium button">STUDY IN CLASSROOM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <ul class="tabs" data-tabs id="example-tabs">
        <div class="grid-container">
              <li class="tabs-title is-active"><a href="#course_content_tab" aria-selected="true">Content</a></li>
              <li class="tabs-title disable"><a data-tabs-target="Course_instructors_tab" href="#Course_instructors_tab">Instructors</a></li>
        </div>
    </ul>

    {{-- Tabs Content Begins here --}}
    <div class="grid-container">  
        
        <div class="tabs-content" data-tabs-content="example-tabs">
            {{-- Course Content Tab --}}
          <div class="tabs-panel is-active" id="course_content_tab">
            <div class="grid-x grid-padding-x">
                <div class="cell medium-8">
                    <h5><strong>What you will learn</strong></h5>
                    <div class="grid-container">
                        <div class="grid-container">
                            <ul class="grid-x grid-padding-x">
                                @foreach ($course->learns as $learn)
                                    <li class="medium-6">{{$learn->body}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <h5><strong>Course Requirement(s)</strong></h5>
                    <div class="grid-container">
                        <div class="grid-container">
                            <ul class="grid-x grid-padding-x">
                                @foreach ($course->requirements as $requirement)
                                    <li class="medium-6">{{$requirement->body}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h5><strong>Course Description</strong></h5>
                        <p>{{$course->description}} </p>
                    </div>
                </div>
                <div class="cell medium-4">
                    <h3>Course Content</h3>
                    <div class="columns">
                        <ul class="accordion" data-accordion>
                            @foreach ($course->sections as $section)
                            <li class="accordion-item" data-accordion-item>
                                <a href="accordion-title">{{$section->title}}</a>
                                <div class="accordion-content" data-tab-content>
                                    <ul>
                                        @foreach ($section->topics as $topic)
                                            <li>{{$topic->title}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
          </div>

          {{-- Course Instructors Tab --}}
          <div class="tabs-panel" id="Course_instructors_tab">
            <p>Suspendisse dictum feugiat nisl ut dapibus.  Vivamus hendrerit arcu sed erat molestie vehicula. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.  Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
          </div>
        </div>
    </div>

</div>
@endsection
