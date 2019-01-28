@extends('layouts.app')

@section('content')
<div class="large__container">
    <div class="grid-container profile__container">
        <div class="grid-x grid-margin-x">
            <div class="shrink user_image">
                <div class="square-box thumbnail">
                    <img src="{{asset('storage/avaters/default_avater.png')}}">
                </div>
            </div>
            <div class="auto user_information">
                <h5 class="user_name">{{$profileUser->name}}</h5>
                <p>member since {{$profileUser->created_at->diffForHUmans()}}</p>
                <a class="button" href="#">Edit Profile</a>     
            </div>
        </div>
    </div>  
</div>

<div class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="cell medium-3">
            <ul class="vertical menu accordion-menu" data-accordion-menu>
              <li><a href="#">Activity Feed</a></li>
              <li>
                <a href="#">My Courses</a>
                <ul class="menu vertical nested">
                  <li><a href="">Active Courses</a></li>
                  <li><a href="/profiles/{{$profileUser->name}}/courses">All Courses</a></li>
                </ul>
              </li>
            </ul>
        </div>
        <div class="cell medium-9">
           @yield('profile_content')
        </div>
    </div>
</div>  
@endsection

