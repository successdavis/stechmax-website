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
                    <div class="medium-4">
                        {{$learn->body}}
                    </div>
                @endforeach
            </div>
            <a class="medium button" href="{{$course->path()}}/subscription?class=false">Subscribe to Series</a>
        </div>
    </div>
    <div class="hero-image" style="background-image: url({{asset($course->thumbnail_path)}})"></div>
</div>
    {{-- ==================================================================== --}}
<div class="grid-container mt-4 mb-3">
    <div class="timeline www-Container">
        <div class="timeline-item">
            <div class="timeline-icon">
                <i class="fas fa-award" ></i>
            </div>
            <div class="timeline-content right">
                <h2 class="timeline-content-date">Certification</h2>
                <p>A certificate from Stechmax speaks volume about you. A Tech Certificate distinguishes you as an expert in the field, with proven levels of skills and knowledge.</p>
            </div>
        </div>
    </div>
</div>
@endsection
