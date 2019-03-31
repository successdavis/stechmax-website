@extends('layouts.app')
@section('content')
    @if (!Auth::check())
        @include('layouts.regFormStreamer')
    @else 
        @include('layouts.noticeStreamer')
    @endif
    <div class="grid-container">
        @include('layouts.what')
    </div>
        @include('layouts.advertBanner')
@endsection
