@extends('layouts.app')

@section('content')
<div class="grid-container">

<div class="grid-x grid-margin-x">
    @include('forum.leftSideBar')

    <div class="cell medium-8 large-8">
        <form method="post" action="/threads">
            @csrf
            <select required name="channel_id">
                <option value="" disabled selected>Please Select A Channel</option>
                @foreach ($channels as $channel)
                    <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}} >{{$channel->name}}</option>
                @endforeach
            </select>
            <label> Whats is the title of your questions?
                <input type="text" name="title" value="{{old('title')}}" required>
            </label>
            <label>
                <textarea placeholder="None" name="body" rows="5" required>{{old('body')}}</textarea>
            </label>
            <button type="submit" class="success button">POST QUESTION</button>
        </form>
        <ul>
            @if (count($errors))
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            @endif
        </ul>
    </div>
  @include('forum.rightSideBar')
</div>
</div>
@endsection
