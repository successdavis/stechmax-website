@extends('layouts.app')

@section('head')
  <script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('content')
<div class="bg-white">
  <div class="container">
    <div class="section">
      <forum-page :channels="{{$channels}}"  @if(auth()->check()) :user="{{ auth()->user() }}" @endif inline-template>
        <div class="columns">
            <div class="column is-3 is-hidden-touch">
                @include('forum.leftSideBar')
            </div>
            <div class="column">
              <div class="columns is-multiline is-mobile">
                <div class="column is-6 is-hidden-desktop">
                  <div class="select ">
                    <select v-model="sortItem" @change="SortThreadsByList">
                      <option value="">Sort</option>
                      <option :value="sort.destination" v-for="sort in sortList" v-text="sort.value"></option>

                      <option v-if="signedIn" :value="sort.destination" v-for="sort in loginsortlist" v-text="sort.value"></option>
                    </select>
                  </div>
                </div>
                <div class="column is-6">
                  <div class="select">
                    <select v-model="sortChannel" @change="sortthreadbychanel">
                      <option value="">Channels</option>
                      <option v-for="channel in channels" v-text="channel.name"></option>
                    </select>
                  </div>
                </div>
                <div class="column">
                  <div class="field">
                    <div class="control">
                      <input class="input is-rounded" type="text" placeholder="Start typing to search">
                    </div>
                  </div>
                </div>
              </div>

              @forelse ($threads as $thread)
                  <div class="is-hidden-desktop">
                    <article class="media is-flex align-center" style="align-items: center">
                      <figure class="media-left">
                        <p class="image is-48x48">
                          <img class="is-rounded" src="{{$thread->creator->avatar_path}}">
                        </p>
                      </figure>
                      <a href="{{$thread->path()}}" class="has-text-black media-content">
                        <div class="content">
                          <p>
                            <strong>{{$thread->creator->f_name . ' ' . $thread->creator->l_name}}</strong>
                            <br>
                          </p>
                        </div>
                      </a>
                      <div class="media-right">
                        <span class="tag is-light is-rounded"><i class="fas fa-comment"></i> {{$thread->replies_count}}</span>
                        <span class="tag is-light is-rounded">{{$thread->channel->name}}</span>
                      </div>
                    </article>
                    <div class="mb-2 mt-1"><strong>{{$thread->title}}</strong></div>
                    <p class="mb-2">{{$thread->excerpt()}}</p>
                  </div>
                  <div class="is-hidden-touch">
                    <article class="has-text-black media is-flex align-center" style="align-items: center">
                      <figure class="media-left">
                        <p class="image is-48x48">
                          <img class="is-rounded" src="{{$thread->creator->avatar_path}}">
                        </p>
                      </figure>
                      <a href="{{$thread->path()}}" class="has-text-black media-content">
                        <div class="content">
                          <br>
                          <div><strong>{{$thread->title}}</strong></div>
                          <p>{{$thread->excerpt()}}</p>
                          <strong>{{strtoupper($thread->creator->username)}} posted: {{$thread->created_at->diffForHumans()}}</strong>
                        </div>
                      </a>
                      <div class="media-right">
                        <span class="tag is-light is-rounded"><i class="fas fa-comment"></i> {{$thread->replies_count}}</span>
                        <span class="tag is-light is-rounded">{{$thread->channel->name}}</span>
                      </div>
                    </article>
                    
                  </div>
              @empty
                <p>There are no relevant results at this time</p>
              @endforelse
              {{$threads->render()}}
            </div>
        </div>
      </forum-page>
    </div>
  </div>
</div>
@endsection
