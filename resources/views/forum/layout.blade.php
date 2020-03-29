@extends('layouts.app')

@section('pageTitle')
  Stechmax IT and Web Development forum 
@endsection

@section('head')
  <script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('content')
<div class="bg-white">
  <div class="container">
    <div class="section">
      <forum-page :channels="{{$channels}}"  @if(auth()->check()) :user="{{ auth()->user() }}" @endif inline-template>
        <div class="columns">
            <div class="column is-3 is-hidden-touch">
                @include('forum.leftSideBar')
            </div>
            <div class="column">
                @yield('forum_content')
            </div>
        </div>
      </forum-page>
    </div>
  </div>
</div>
@include('layouts.footer')
@endsection
