@extends('layouts.app')

@section('content')
<div class="grid-container ">
    <div class="row mb-3">

        <div class="search-form grid-x grid-padding-x mb-4 mt-4">
        <div class="text-info">
          
          <h3>Here is a list of courses offered</h3>
          <p>You can sort or search this page for precise courses</p>
        </div>
          <div class="cell large-8">
            <div class="input-group">
              <span class="input-group-label">
                <i class="fas fa-search"></i>
              </span>
              <input class="input-group-field" type="text" placeholder="You can search for lessons here" name="search" id="search">
            </div>
          </div>
          <div class="cell medium-6 large-4 grid-x">
            <div class="small-4">
              <span data-toggle="subjects-dropdown">All Topics <i class="fas fa-angle-down"></i></span>
              <div class="dropdown-pane" id="subjects-dropdown" data-dropdown data-auto-focus="true">
                <ul>
                  <li><a href="/courses">All Courses</a></li>
                  @foreach ($subjects as $subject)
                    <li><a href="/courses/{{$subject->slug}}">{{$subject->name}}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="small-4">
                <span data-toggle="sort-subject">Courses <i class="fas fa-angle-down"></i></span>
                <div class="dropdown-pane" id="sort-subject" data-dropdown data-auto-focus="true">
                  <ul>
                    <li><a href="/courses">Newest</a></li>
                    <li><a href="/courses?fee=asc">Price: Low to High</a></li>
                    <li><a href="/courses?fee=desc">Price: High to Low</a></li>
                    <li><a href="/courses?alphabet=asc">Alphabetically</a></li>
                    <li><a href="/courses">Only Series</a></li>
                    <li><a href="/courses">Only Courses</a></li>
                  </ul>
                </div>
            </div>
            <div class="small-4">
                <span data-toggle="sort-difficulty">Difficulty <i class="fas fa-angle-down"></i></span>
                <div class="dropdown-pane" id="sort-difficulty" data-dropdown data-auto-focus="true">
                  <ul>
                    <li><a href="/courses?difficulty=beginner">Beginner</a></li>
                    <li><a href="/courses?difficulty=intermediate">Intermediate</a></li>
                    <li><a href="/courses?difficulty=advance">Advance</a></li>
                    <li><a href="/courses?difficulty=pro">Pro</a></li>
                  </ul>
                </div>
            </div>
          </div>
        </div>
        <div class="mt-3">
          <h4>Single Courses</h4>
          <div class="grid-x grid-padding-x">
            @forelse ($courses as $course)
                @if (strtolower($course->checkType()) === 'course')
                  @include('courses.course')
                @endif
            @empty
            <p>There are not result at this time</p>
            @endforelse
          </div>
          <h4>Track Courses</h4>
        </div>
        <div class="grid-x grid-padding-x">
            @forelse ($courses as $track)
                @if (strtolower($track->checkType()) === 'track')
                  @include('courses.track')
                @endif
            @empty
            <p>There are not result at this time</p>
            @endforelse
          </div>
    </div>
</div>
@endsection

