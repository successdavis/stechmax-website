@extends('layouts.app')
@section('content')
@if (!Auth::check())
    @include('layouts.regFormBanner')
@else 
    @include('layouts.banner')
@endif
<div class="grid-container">
    @include('layouts.what')
</div>
    @include('layouts.advertBanner')
@endsection
