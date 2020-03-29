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

    <title>@yield('pageTitle')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <script src="https://js.paystack.co/v1/inline.js"></script>
    
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn'  => Auth::check()      
        ]) !!};
    </script>
    @yield('head')
</head>
<body>
<div id="app">
    <div id="app">
        <vue-progress-bar></vue-progress-bar>
        @include('layouts.navbar')
        @yield('content')
        <flash message="{{ session('flash') }}"></flash>
        {{-- @include('layouts.footer') --}}
    </div>
</div>
</body>

<!-- Scripts -->
<script type="application/javascript" src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/remita-pay-inline.bundle.js') }}" ></script>

<script src="{{ asset('videojs-playlist/dist/videojs-playlist.js') }}"></script>
@yield('body-close')

</body>
</html>
