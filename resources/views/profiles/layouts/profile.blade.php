@extends('layouts.app')

@section('content')
<div class="large__container">
    <div class="grid-container profile__container">
        <div class="grid-x grid-margin-x">
            <div class="shrink user_image">
                <avatar-form :user="{{$profileUser}}"></avatar-form>
            </div>
            <div class="auto user_information">
                <h5 class="user_name">{{$profileUser->f_name . ' ' . $profileUser->l_name}}</h5>
                <p>member since {{$profileUser->created_at->diffForHUmans()}}</p>
            </div>
        </div>
    </div>  
</div>

<div class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="cell medium-3">
            <ul class="vertical menu accordion-menu" data-accordion-menu>
              <li><a href="#">Activity Feed</a></li>
            </ul>
        </div>
        <div class="cell medium-9">
           @yield('profile_content')
        </div>
    </div>
</div>  
@endsection

