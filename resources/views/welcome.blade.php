@extends('layouts.app')
@section('pageTitle')
  Success Techmax - Best ICT Training Centre Obudu, Cross River State
@endsection
@section('content')
    <home-streamer></home-streamer>
    @include('layouts.homepage-hero')
    @include('layouts.subjects')
    @include('layouts.what')

    @include('layouts.servicesoffered')

    @include('layouts.program')
    @include('layouts.advertBanner')
     <testimonial-carousels></testimonial-carousels>
    @include('layouts.testimonials')
    @include('layouts.footer')
@endsection
