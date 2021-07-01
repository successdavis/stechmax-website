@extends('layouts.app')

@section('head')
	<script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection


@section('pageTitle')
  Learn {{$course->title}} at Stechmax
@endsection

@section('content')
	@include("courses.partials._courseStreamer")
	@include("courses.partials._tabs")
	
	<!-- @include('layouts.footer') -->
@endsection

