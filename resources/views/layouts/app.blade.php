<?php
    $displayMenu = isset($displayMenu) ? $displayMenu : false;  
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

    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

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
        <div class="off-canvas off-canvas_panel position-left bg--dark-blue @if ($displayMenu)
          {{"reveal-for-medium"}} @endif" id="offCanvasLeftOverlap" data-off-canvas data-transition="overlap">

            {{-- button to toggle off canvas --}}
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


        {{-- Offcanvas page content goes here --}}
        <div class="off-canvas-content" data-off-canvas-content>
              
           {{-- Include the title bar --}}
           @include('layouts.title-bar')
            
            
            <main class="py-4 margin-top-large" id="site-body">
                @yield('content')
                
                <flash message="{{ session('flash') }}"></flash>
            </main>

        </div> {{-- closing off canvas content --}}
    </div> {{-- closing wrapper div --}}

</div>
@if ($displayMenu !== true)
    @include('layouts.footer')
@else
    <div class="mb-4"></div>
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
