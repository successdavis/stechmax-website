@extends('layouts.app')
@section('pageTitle')
  Success Techmax - Best ICT Training Centre Obudu, Cross River State
@endsection
@section('content')
    <home-streamer></home-streamer>
    @include('layouts.homepage-hero')
    @include('layouts.program')
    @include('layouts.childeducation-hero')
    
    @include('layouts.subjects')
    @include('layouts.what')

    <!-- @include('layouts.servicesoffered')     -->
    <!-- @include('layouts.testimonials') -->

    @include('layouts.advertBanner')
    <h3 id="message" class="has-text-centered is-size-3">Talk to us</h3>
    <contactform></contactform>
    @include('layouts.footer')
@endsection
