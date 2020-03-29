@extends('layouts.app')

@section('pageTitle')
  Learn {{$course->title}} at Stechmax
@endsection

@section('content')
	@include("courses.partials._courseStreamer")
	@include("courses.partials._tabs")
@endsection
