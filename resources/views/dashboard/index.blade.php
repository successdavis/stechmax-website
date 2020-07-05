@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
  <div class="section">
    @if (Auth::user()->isAdmin())
      @include('dashboard.partials.adminStatusCard')
    @else
      @include('dashboard.partials.studentStatusCard')
      <div class="columns">
      	<div class="column is-6">
	      @include('dashboard.partials.userExperienceCard')
      	</div>
      	<div class="column is-6">
      		
      	</div>
      </div>
    @endif

    {{-- @include('dashboard.partials.RecentRegisteredStudents') --}}
    {{-- @include('dashboard.partials.CommentsCard') --}}
  </div>

   
@endsection
