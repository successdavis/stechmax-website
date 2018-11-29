@extends('layouts.app')

@section('content')
<div class="grid-container">

<div class="grid-x grid-margin-x">
    <div class="cell medium-3 large-2">
        <a href="/threads/new" class="button">POST A QUESTION</a>
        <ul>
            <li><a href="">All Threads</a></li>
            <li><a href="">My Questions</a></li>
        </ul>
    </div>
    <div class="cell medium-8 large-8">
        @foreach ($threads as $thread)
            <li> 
                <a href="{{ $thread->path() }}">{{$thread->title}}</a>
                <p>{{ $thread->body}} </p>
            </li>
        @endforeach
    </div>
  <div class="cell large-2">
      <h6 class="bold"><strong>Channels</strong></h6>
  </div>
</div>
</div>
@endsection
