@extends('layouts.app')

@section('content')
<div class="grid-container">

<div class="grid-x grid-margin-x">
    <div class="cell medium-3 large-2">
        <ul>
            <li><a href="">All Threads</a></li>
            <li><a href="">My Questions</a></li>
        </ul>
    </div>
    <div class="cell medium-8 large-8">
        <div class="card">
            <div class="card-section">
                <h6><strong><a href="">{{$thread->creator->name}}</a> </strong> | {{$thread->created_at->diffForHumans()}} <br> <strong>{{$thread->title}}</strong></h6>
                <p>{{$thread->body}}</p>
            </div>
        </div>
        <hr>
            @foreach ($thread->replies as $reply)
            <div class="card">
                <div class="card-section">
                    <h6><a href="">{{$reply->owner->name}}</a>  said: {{$reply->created_at->diffForHumans()}}</h6>
                    <p>{{$reply->body}}</p>
                </div>
            </div>
            @endforeach
            @if (auth()->check())
                <form method="post" action="/threads/channel/{{$thread->id}}/replies">
                    @csrf
                    <label>
                        <textarea placeholder="Have something to say" name="body" rows="5"></textarea>
                        <button type="submit" class="success button">POST</button>
                    </label>
                </form>
            @else 
            <p class="text-center">Please <a href="{{route('login')}}">Sign In</a> in to participate in the Conversation</p>
            @endif
    </div>
    {{-- ================================================= --}}
  <div class="cell large-2">
      <h6 class="bold"><strong>Channels</strong></h6>
  </div>
</div>
</div>
@endsection
