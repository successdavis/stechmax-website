@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
  <div class="section">
    @if (Auth::user()->isAdmin())
      @include('dashboard.partials.adminStatusCard')
    @else
      @include('dashboard.partials.studentStatusCard')
    @endif

    {{-- @include('dashboard.partials.RecentRegisteredStudents') --}}
    {{-- @include('dashboard.partials.CommentsCard') --}}
  </div>

   
@endsection
