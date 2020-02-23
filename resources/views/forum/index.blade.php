@extends('layouts.app')

@section('content')
  <div class="container bg-white">
    <div class="section">
      <forum-page :channels="{{$channels}}" inline-template>
        <div>
          <div class="columns is-mobile">
            <div class="column is-6">
              <div class="select">
                <select v-model="sortItem">
                  <option value="">Sort</option>
                  <option :value="sort.destination" v-for="sort in sortList" v-text="sort.value"></option>
                  <option v-for="sort in loginsortlist" v-text="sort.value"></option>
                </select>
              </div>
            </div>
            <div class="column is-6">
              <div class="select">
                <select v-model="sortItem">
                  <option value="">Channels</option>
                  <option v-for="channel in channels" v-text="channel.name"></option>
                </select>
              </div>
            </div>
          </div>

          @forelse ($threads as $thread)

            <article class="media is-flex align-center" style="align-items: center">
              <figure class="media-left">
                <p class="image is-48x48">
                  <img class="is-rounded" src="{{$thread->creator->avatar_path}}">
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>{{$thread->creator->f_name . ' ' . $thread->creator->l_name}}</strong>
                    <br>
                  </p>
                </div>
              </div>
              <div class="media-right">
                <span class="tag is-light is-rounded"><i class="fas fa-comment"></i> {{$thread->replies_count}}</span>
                <span class="tag is-light is-rounded">{{$thread->channel->name}}</span>
              </div>
            </article>
              <div class="mb-2 mt-1"><strong>{{$thread->title}}</strong></div>
              <p class="mb-2">{{$thread->excerpt()}}</p>

          @empty
            <p>There are no relevant results at this time</p>
          @endforelse
        </div>

      </forum-page>
    </div>
  </div>
@endsection
