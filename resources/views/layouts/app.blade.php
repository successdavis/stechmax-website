<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/foundation.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>
<body>

<div id="app">
    <div class="off-canvas-wrapper">
        <div class="off-canvas position-left" id="offCanvasLeftOverlap" data-off-canvas data-transition="overlap">
            <button class="close-button" aria-label="Close menu" type="button" data-close>
              <span aria-hidden="true">&times;</span>
            </button>


          <!-- Your menu or Off-canvas content goes here -->
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
                  <li><a href="{{ url('/courses') }}">COURSES</a></li>
                  <li><a href="{{ url('/threads') }}">FORUM</a></li>
                </ul>
              </div>
              <div class="top-bar-right">
                <ul class="menu">
                @guest
                  <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                  <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
                @else
                <li><a class="no-padding">
                    <div class="profile-card-avater">
                        <img src="{{asset('storage/avaters/default_avater.png')}}" class="avater-image"  data-toggle="user_profile-menu">
                    </div>
                    <div class="dropdown-pane" id="user_profile-menu" data-position="bottom" data-alignment="right" data-dropdown>
                        <ul>
                            <li><a href="#">{{ Auth::user()->name }}</a></li>
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
            
            <main class="py-4">
                @yield('content')
            </main>

        </div> {{-- closing off canvas content --}}
    </div> {{-- closing wrapper div --}}

</div>

</body>

<!-- Scripts -->
<script src="/js/vendor/jquery.js"></script>
<script src="/js/vendor/what-input.js"></script>
<script src="/js/vendor/foundation.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/laravel.js') }}" defer></script>
{{-- <script src="/js/app.js"></script> --}}
<script src="/js/ajax.js"></script>
<script src="/js/application.js"></script>

<script type="text/javascript">
    $(document).foundation();20
</script>
</body>
</html>
