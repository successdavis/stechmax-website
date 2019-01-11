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
            <ul>
                <li>Activity Feed</li>
            </ul>
        </div>
        <div class="cell medium-9">
            @forelse ($activities as $date => $activity)
                <h4>{{ $date }}</h4>
                @foreach ($activity as $record)
                    @if (view()->exists("profiles.activities.{$record->type}"))
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            @empty
                <p>There is no activity for this User yet</p>
            @endforelse
        </div>
    </div>
</div>  
@endsection

