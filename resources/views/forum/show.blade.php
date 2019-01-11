@extends('layouts.app')

@section('content')
<div class="grid-container">

<div class="grid-x grid-margin-x"> 
   
    @include('forum.leftSideBar')
   
    <div class="cell medium-8 large-8">
        <div class="card">
            <div class="card-section">
                <div class="grid-x grid-margin-x">
                    <div class="medium-9">
                        <h6><strong><a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a> </strong> | {{$thread->created_at->diffForHumans()}} <br> <strong>{{$thread->title}}</strong></h6>
                    </div>
                    <div class="medium-3 p_meta-data">
                        <span class="p-text-grey-darker">
                            <i class="fi-comment-minus"></i>
                            {{$thread->replies_count}}
                        </span>
                        <span>
                            <a class="p_red-tiny-button" href="/threads/{{$thread->channel->slug}}">{{$thread->channel->name}}</a>
                        </span>
                        @can('update', $thread )
                            <form method="post" action="{{ $thread->path()}}">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="small button">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
                <p>{{$thread->body}}</p>
            </div>
        </div>
        <hr>
            @foreach ($replies as $reply)
                @include('forum.reply')
            {{$replies->links()}}
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
  @include('forum.rightSideBar')
</div>
</div>
@endsection
