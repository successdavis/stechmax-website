@extends('layouts.app')
@section('content')
    <home-streamer></home-streamer>
    @include('layouts.subjects')
    @include('layouts.what')

    @include('layouts.program')
    @include('layouts.advertBanner')
    {{-- @include('layouts.testimonials') --}}
@endsection
