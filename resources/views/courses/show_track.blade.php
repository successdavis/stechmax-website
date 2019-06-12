@extends('layouts.app')

@section('content')
<div id="path-header" class="full-height-fixed align-middle">
    <div class="grid-x grid-container path-info">
        <div class="medium-7">
            <a href="/courses/{{$course->subject->slug}}" class="mb-3 tiny-button">{{$course->subject->name}} </a>
            <h3 class="mb-1 mt-1 ">{{$course->title}}</h3>
            <p class="mb-3">{{$course->description}} </p>
            <div class="grid-x grid-padding-x mb-2">
                @foreach ($course->learns()->get() as $learn)
                    <div class="cell medium-4">
                        {{$learn->body}}
                    </div>
                @endforeach
            </div>
            <a class="medium button" href="{{$course->path()}}/subscription?class=true">Subscribe to Series</a>
        </div>
    </div>
    <div class="hero-image" style="background-image: url({{asset($course->thumbnail_path)}})"></div>
</div>
    {{-- ==================================================================== --}}
<div class="grid-container mt-4 mb-4">
    @foreach ($course->childrenCourses()->get() as $index => $linkCourse)
        <div class="step">
            <div>
                <div class="circle">{{$index + 1}}</div>
            </div>
            <div>
                <div class="grid-x grid-padding-x">
                    <div class="cell medium-3">
                        <img src="{{asset($linkCourse->thumbnail_path)}}">
                    </div>
                    <div class="cell medium-6">
                        <div class="title"><a href="{{$linkCourse->path()}}">{{$linkCourse->title}} </a></div>
                        <div class="">{{$linkCourse->description}} </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>  
    @endforeach
</div>

@endsection
