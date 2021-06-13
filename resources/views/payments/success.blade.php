@extends('layouts.app')

@section('content')

<div class="container">
    <div class="section">
        <center>
            <p class="has-text-centered heading is-size-4">Thank you for your payment</p>
            <p class="has-text-centered is-size-5">You are now subscribe to {{$course->title}}</p>
            <div class="section">
                click <a href="{{$course->firstLectureUrl()}}">Here</a> to begin your training 
                <a href="{{$course->firstLectureUrl()}}" class="button is-success">PLAY EPISODES</a>
            </div>
        </center>
    </div>
</div>

</div>
@endsection

