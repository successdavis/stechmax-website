@extends('layouts.app')

@section('content')

    @include('websiteservice.partials.hero');
    @include('websiteservice.partials.you-need-a-website');
    @include('websiteservice.partials.what-our-clients-say');
    @include('websiteservice.partials.some-of-our-projects');

@include('layouts.footer')
@endsection
