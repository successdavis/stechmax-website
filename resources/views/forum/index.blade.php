@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach ($threads as $thread)
            <li> <a href="{{ $thread->path() }}">{{$thread->title}}</a></li>
        @endforeach
    </ul>
</div>
@endsection
