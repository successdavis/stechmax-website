@extends('layouts.app')

@section('content')

<div class="grid-container">

<div class="grid-x grid-margin-x grid-padding-x mt-3">
    <div class="hide-for-small-only">
        @include('forum.leftSideBar')
    </div>
    <div class="cell medium-8 large-8">
        <div class="">
            <div class="grid-x grid-padding-x">
                <div class=" cell medium-6">
                    <div class="input-group">
                      <input class="input-group-field" type="text" placeholder="Watcha Looking for?">
                      <div class="input-group-button">
                        <input type="submit" class="button" value="Submit">
                      </div>
                    </div>
                </div> 
                <div class="cell medium-6">
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="small-6">
                                  <select>
                                    <option value="husker">Husker</option>
                                    <option value="starbuck">Starbuck</option>
                                    <option value="hotdog">Hot Dog</option>
                                    <option value="apollo">Apollo</option>
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
        </div>

        @forelse ($threads as $thread)
        <div class="grid-x grid-padding-x mb-2">
            <div class="small-1">{{ucwords(substr($thread->creator->name, 0, 1))}}</div>
            <div class="small-9">
                <strong><a class="black-text" href="{{$thread->path() }}">{{$thread->title}}</a></strong>
                <p class="gray-text">{{ $thread->body}} </p>
                <p style="font-size: 13px">
                    Posted {{$thread->created_at->diffForHumans()}} by 
                    <a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a>
                </p>
            </div>
            <div class="small-2 center-elements">
                <div>
                    <a class="p_red-tiny-button" href="/threads/{{$thread->channel->slug}}">{{$thread->channel->name}}</a>
                </div>
                <div class="p-text-grey-darker">
                    <i class="fi-comment-minus"></i>
                    {{$thread->replies_count}}
                </div>
            </div>
        </div>

        @empty
        <p>There are no relevant results at this time</p>
        @endforelse
    </div>
    <div class="hide-for-small-only">
      @include('forum.rightSideBar')
    </div>
</div>
</div>
@endsection
