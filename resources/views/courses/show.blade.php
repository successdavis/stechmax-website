@extends('layouts.app')

@section('content')
        <div class="course-big-banner">
            <div id="grid-container">
                <div class="course-big-banner--content grid-container">
                    <h2>{{$course->title}}</h2>
                    @if (! auth()->check() || ! $course->isSubscribedBy(auth()->user()))
                        <div class="grid-x grid-padding-x">
                            <div class="medium-6">
                                <div class="grid-container">
                                    <div>Study remotely at the comfort of your home with a smart phone or PC, One-on-One with your tutor</div>
                                    <a href="{{$course->path()}}/subscription?class=false" class="medium button">STUDY ONLINE</a>
                                </div>
                            </div>
                            <div class="medium-6">
                                <div class="grid-container">
                                    <div>Study online and also share physical interactions with tutors at the esteemed institute.</div>
                                    <a href="{{$course->path()}}/subscription?class=true" class="medium button">STUDY IN CLASSROOM</a>
                                </div>
                            </div>
                        </div>
                    @else ()
                        <div class="center-align">
                            <a href="" class="medium button">You are subscribe to this course</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <ul class="tabs" data-tabs id="example-tabs">
            <div class="grid-container">
                <li class="tabs-title is-active"><a href="#course_content_tab" aria-selected="true">Content</a></li>
                <li class="tabs-title disable"><a data-tabs-target="Course_instructors_tab" href="#Course_instructors_tab">Instructors</a></li>
                @if (auth()->check() && $course->isSubscribedBy(auth()->user()))
                    <li class="tabs-title"><a data-tabs-target="Course_materials_tab" href="#Course_materials_tab">Course Materials</a></li>
                    <li class="tabs-title"><a data-tabs-target="Course_questions_tab" href="#Course_questions_tab">Questions</a></li>
                @endif
            </div>
        </ul>

        {{-- Tabs Content Begins here --}}
        <div class="grid-container">

            <div class="tabs-content" data-tabs-content="example-tabs">
                {{-- Course Content Tab --}}
                <div class="tabs-panel is-active" id="course_content_tab">
                    <div class="grid-x grid-padding-x">
                        <div class="cell medium-8 double-line-height ">
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
                                    <ul class="grid-x grid-padding-x double-line-height ">
                                        @foreach ($course->requirements as $requirement)
                                            <li class="medium-6">{{$requirement->body}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <h5><strong>Course Description</strong></h5>
                                <p class="double-line-height">{{$course->description}} </p>
                            </div>
                        </div>
                        <div class="cell medium-4">
                            <h3>Course Content</h3>
                            <div class="columns">
                                <ul class="accordion" data-accordion data-accordion data-multi-expand="true">
                                    @foreach ($course->getSections() as $index => $section)
                                        <li class="accordion-item is-active" data-accordion-item>
                                            <a class="front-end-section relative-body" href="accordion-title"><i class="far fa-file-alt"></i> <strong>Section {{$index + 1}}: </strong>{{$section->title}} <i class="fas fa-long-arrow-alt-down top-right-button"></i></a>
                                            <div class="accordion-content" data-tab-content>
                                                @foreach ($section->lectures as $topic)
                                                    <div class="front-end-course"><i class="far fa-play-circle"></i> {{$topic->title}}</div>
                                                @endforeach
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
                    <p>This section is still under development</p>
                </div>
                @if (auth()->check() && $course->isSubscribedBY(auth()->user()))
                    <div class="tabs-panel" id="Course_materials_tab">
                        <p>In here you will find PDF materials to this course</p>
                    </div>
                    <div class="tabs-panel" id="Course_questions_tab">
                        <p>There are no questions at the moment</p>
                    </div>
                @endif
            </div>
        </div>

        </div>
@endsection
