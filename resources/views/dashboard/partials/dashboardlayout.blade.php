@extends('layouts.app')

@section('content')
<div class="columns">
  <div class="column aside is-2 has-background-grey-darker">
    @include('dashboard.partials.dashboard-menu')
  </div>
  <div class="column main">
      @yield('dashboardcontent')
  </div>
 
</div>

   
@endsection
