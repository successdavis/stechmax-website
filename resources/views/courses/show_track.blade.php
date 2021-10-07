@extends('layouts.app')

@section('content')
<div id="path-header" class="full-height-fixed align-middle">
    <div class="grid-x grid-container path-info">
        <div class="medium-7">
            <a href="/courses/{{$course->subject->slug}}" class="mb-3 tiny-button">{{$course->subject->name}} </a>
            <h3 class="mb-1 mt-1 ">{{$course->title}}</h3>
            <p class="mb-3">{{$course->sypnosis}} </p>
            <div class="grid-x grid-padding-x mb-2">
                @foreach ($course->learns()->limit(3)->get() as $learn)
                    <div class="cell medium-4">
                        {{$learn->body}}
                    </div>
                @endforeach
            </div>
            <div class="grid-x">
                <div class="medium-6 cell">
                    <h3 class="inline">&#8358;{{$course->getTrackAmount()}} </h3>
                </div>
                <div class="medium-6 cell">
                    <a class="medium button" href="{{$course->path()}}/subscription?class=false">Study Series Online</a>
                    <a class="medium button" href="{{$course->path()}}/subscription?class=true">Study Series Offline</a>
                </div>
            </div>
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
