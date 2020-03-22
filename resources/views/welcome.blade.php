@extends('layouts.app')
@section('content')
    <home-streamer></home-streamer>
    @include('layouts.subjects')
    @include('layouts.what')

    @include('layouts.program')
    @include('layouts.advertBanner')
    {{-- <testimonial-carousels></testimonial-carousels> --}}
    @include('layouts.testimonials')
    @include('layouts.footer')
@endsection
