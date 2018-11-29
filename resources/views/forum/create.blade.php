@extends('layouts.app')

@section('content')
<div class="grid-container">

<div class="grid-x grid-margin-x">
    @include('forum.leftSideBar')

    <div class="cell medium-8 large-8">
        <form method="post" action="/threads">
            @csrf
            <label> Whats is the title of your questions?
                <input type="text" name="title">
            </label>
            <label>
                <textarea placeholder="None" name="body" rows="5"></textarea>
            </label>
            <button type="submit" class="success button">POST QUESTION</button>
        </form>
    </div>

  @include('forum.rightSideBar')
</div>
</div>
@endsection
