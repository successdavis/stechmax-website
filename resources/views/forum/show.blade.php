@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{$thread->replies_count}}" inline-template>
<div class="grid-container">

<div class="grid-x grid-margin-x mt-3"> 
   
    @include('forum.leftSideBar')
   
    <div class="cell medium-8 large-8">
        <div class="card">  
            <div class="card-section">
                <div class="card-title grid-x">
                    <div class="medium-8">
                        <h6><strong><a href="/profiles/{{$thread->creator->f_name . $thread->creator->l_name}}">{{$thread->creator->f_name . ' ' . $thread->creator->l_name}}</a> </strong> | {{$thread->created_at->diffForHumans()}}
                        </h6>
                    </div>
                    <div class="medium-4">
                        <span class="p-text-grey-darker" v-text="repliesCount">
                            <i class="fi-comment-minus"></i>
                        </span>
                        <span>
                            <a class="p_red-tiny-button" href="/threads/{{$thread->channel->slug}}">{{$thread->channel->name}}</a>
                        </span>
                        @can('update', $thread )
                            <form method="post" action="{{ $thread->path()}}" class="auto inline">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="small mb-reset"><i class="fas fa-trash"></i></button>
                            </form>
                        @endcan
                        <span>
                            <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                        </span>
                    </div>
                </div>
                <div class="thread-header">
                    <h5>{{$thread->title}}</h5>
                </div>
                <p>{{$thread->body}}</p>
            </div>
        </div>
        <hr>

            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
           
    </div>
    {{-- ================================================= --}}
  @include('forum.rightSideBar')
</div>
</div>
</thread-view>
@endsection
