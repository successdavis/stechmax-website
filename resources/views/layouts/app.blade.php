<?php
  
  $pageTitle = isset($pageTitle) ? $pageTitle : 'Welcome Stechmax';

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$pageTitle}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/foundation.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Foundation Icons -->
    <link rel="stylesheet" href="/css/foundation-icons.css">
    <link rel="stylesheet" href="/foundation-icons/foundation-icons.css">
    
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn'  => Auth::check()      
        ]) !!};
    </script>

</head>
<body>
<body>

<div id="app">
    <div class="off-canvas-wrapper">
        <div class="off-canvas position-left @if ($pageTitle === 'Dashboard - Stechmax')
          {{"reveal-for-medium"}}
        @endif" id="offCanvasLeftOverlap" data-off-canvas data-transition="overlap">
            <button class="close-button" aria-label="Close menu" type="button" data-close>
              <span aria-hidden="true">&times;</span>
            </button>
          <!-- Your menu or Off-canvas content goes here -->
          @guest
            @include('layouts.off-canvas-content-guest')
          @else
            @include('layouts.off-canvas-content')
          @endguest
        </div>
        <div class="off-canvas-content" data-off-canvas-content>
              
            <div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
              {{-- <button class="menu-icon" type="button" data-toggle="responsive-menu"></button> --}}
              <button type="button" class="menu-icon" data-toggle="offCanvasLeftOverlap"></button>
              <div class="title-bar-title">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'STECHMAX') }}
                </a>
              </div>
            </div>

            <div class="top-bar" id="responsive-menu">
              <div class="top-bar-left">
                <ul class="dropdown menu" data-dropdown-menu>
                  <li>
                    <a class="menu-text" href="{{ url('/') }}">
                      {{ config('app.name', 'STECHMAX') }}
                    </a>
                  </li>
                  <li><a href="{{ url('/courses') }}" data-toggle="library-dropdown">LIBRARY  <i class="fas fa-angle-double-down"></i></a></li>
                  <div class="dropdown-pane overlap-all" id="library-dropdown" data-dropdown data-auto-focus="true" data-hover="true" data-hover-pane="true" style="width: 100%">
                    <div class="grid-x grid-padding-x">
                      <div class="cell">
                        <ul class="vertical dropdown menu" data-dropdown-menu style="max-width: 250px;">
                           @foreach ($subjects as $subject)
                             <li>
                               <a href="/courses/{{$subject->slug}}">{{$subject->name}}</a>
                               <ul class="vertical menu nested">
                                @foreach ($subject->courses as $course)
                                 <li><a href="#">{{$course->title}}</a></li>
                                @endforeach
                               </ul>
                             </li>
                           @endforeach
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                  <li><a href="{{ url('/threads') }}">FORUM</a></li>
                </ul>
              </div>
              <div class="top-bar-right">
                <ul class="menu">
                @guest
                  <li><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __(' Login') }}</a></li>
                  <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
                @else
                <li><a><i class="far fa-envelope"></i></a></li>
                <user-notifications></user-notifications>
                <li><a class="no-padding">
                    <div class="profile-card-avater">
                        <img src="{{asset('storage/avaters/default_avater.png')}}" class="avater-image"  data-toggle="user_profile-menu">
                    </div>
                    <div class="dropdown-pane" id="user_profile-menu" data-position="bottom" data-alignment="right" data-dropdown>
                        <ul>
                            <li><a href="/profiles/{{Auth::user()->email}}">{{ Auth::user()->f_name . ' ' . Auth::user()->l_name }}</a></li>
                            <li><a href="/home">Dashboard</a></li>
                            <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </a></li>
                @endguest
              </div>
            </div>
            
            <main class="py-4 margin-top-large" id="site-body">
                @yield('content')

                <flash message="{{session('flash')}}"></flash>
            </main>

        </div> {{-- closing off canvas content --}}
    </div> {{-- closing wrapper div --}}

</div>
@if ($pageTitle !== 'Dashboard - Stechmax')
    @include('layouts.footer')
@endif


</body>

<!-- Scripts -->
<script src="/js/vendor/jquery.js"></script>
<script src="/js/vendor/what-input.js"></script>
<script src="/js/vendor/foundation.js"></script>
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/remita-pay-inline.bundle.js') }}" ></script>

<script type="text/javascript">
    $(document).foundation();
</script>
</body>
</html>
