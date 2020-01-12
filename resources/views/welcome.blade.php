@extends('layouts.app')
@section('content')
    @if (!Auth::check())
        @include('layouts.regFormStreamerTwo')
    @else 
        @include('layouts.regFormStreamerTwo')
    @endif
   {{--  <div>
        @include('layouts.subjects')
    </div> --}}
    <div class="grid-container">
        @include('layouts.what')
    </div>
    @include('layouts.program')
    @include('layouts.advertBanner')
@endsection
