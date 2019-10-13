@extends('layouts.app')

@section('content')

<div class="grid-container">

<div class="grid-x grid-margin-x grid-padding-x mt-3">
    <div class="hide-for-small-only">
        @include('forum.leftSideBar')
    </div>
    <div class="cell medium-8 large-8">
        <div class="grid-x grid-padding-x">
            <form method="GET" action="/threads/search">
                <div class="cell">
                    <div class="input-group">
                          <input class="input-group-field" name="q" type="text" placeholder="Watcha Looking for?">
                          <div class="input-group-button">
                            <input type="submit" class="button" value="Submit">
                          </div>
                    </div>
                </div> 
            </form>
            <div class="cell medium-6">
                <div class="grid-container">
                    <div class="grid-x grid-padding-x">
                        <div class="small-6">
                              <select>
                                @foreach ($channels as $channel)
                                    <option><a href="/threads/">{{$channel->name}}</a></option>
                                @endforeach
                              </select>
                        </div>
                        <div class="small-6">
                              <select>
                                <option value="husker">Husker</option>
                                <option value="starbuck">Starbuck</option>
                                <option value="hotdog">Hot Dog</option>
                                <option value="apollo">Apollo</option>
                              </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @forelse ($threads as $thread)
        <div class="grid-x grid-padding-x mb-2">

            <div class="small-1">
            <img src="{{$thread->creator->avatar_path}}" style="width: 30px; height: 30px;">
                {{ucwords(substr($thread->creator->f_name, 0, 1))}}
            </div>
            <div class="small-9">
                <strong><a class="black-text" href="{{$thread->path() }}">{{$thread->title}}</a></strong>
                <p class="gray-text">{{ $thread->body}} </p>
                <p style="font-size: 13px">
                    Posted {{$thread->created_at->diffForHumans()}} by 
                    <a href="/profiles/{{$thread->creator->email}}">{{$thread->creator->f_name . ' ' . $thread->creator->l_name}}</a>
                </p>
            </div>
            <div class="small-2 center-elements">
                <div>
                    <a class="p_red-tiny-button" href="/threads/{{$thread->channel->slug}}">{{$thread->channel->name}}</a>
                </div>
                <div class="p-text-grey-darker">
                    <i class="fi-comment-minus"></i>
                    {{$thread->replies_count}}
                    <span>
                        <i class="fas fa-eye"></i>
                        {{$thread->visits}}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <p>There are no relevant results at this time</p>
        @endforelse
        {{$threads->render()}}
    </div>
    <div class="hide-for-small-only">
      @include('forum.rightSideBar')
    </div>
</div>
</div>

{{-- hello world --}}
<div class="uper__nav">
   <div class="grid-x grid-margin-x">
       <div class="cell small-4">
           <div class="">
               
           </div>
           
       </div>
       <div class="cell auto">
           
       </div>
       <div class="cell small-4">
           
           
       </div>
   </div> 
</div>


@endsection
