@extends('layouts.app')

@section('content')

    <section class="hero is-medium is-primary is-bold">
      <div class="hero-body">
        <div class="container">
            <!-- Main container -->
            <nav class="level">
              <!-- Left side -->
              <div class="level-left">
                <div class="level-item">
                    <div class="">
                      <article class="media">
                        <div class="media-left">
                          <figure class="image is-128x128">
                            <avatar-form :user="{{$profileUser}}"></avatar-form>
                          </figure>
                        </div>
                        <div class="media-content">
                          <div class="content">
                            <p>
                              <strong class="is-size-3 has-text-white">{{$profileUser->f_name . ' ' . $profileUser->l_name}}</strong> 
                              <div>member since {{$profileUser->created_at->diffForHUmans()}}</div>
                            </p>

                          </div>
                        </div>
                      </article>
                    </div>
                </div>
              </div>

              <!-- Right side -->
              <div class="level-right">
                {{-- <p class="level-item"> --}}
                   <div class="tile is-ancestor">
                      <div class="tile is-vertical is-8">
                        <div class="tile">
                          <div class="tile is-parent">
                            <article class="tile is-child notification is-info">
                              {{-- <p class="title">Middle tile</p> --}}
                              {{-- <p class="subtitle">With an image</p> --}}
                              <figure class="profile-page-card has-background-white image is-128x128">
                                <p class="title has-text-dark">55</p>
                                <p>Exp Points</p>
                              </figure>
                            </article>
                          </div>
                          <div class="tile is-parent">
                            <article class="tile is-child notification is-info">
                              {{-- <p class="title">Middle tile</p> --}}
                              {{-- <p class="subtitle">With an image</p> --}}
                              <figure class="profile-page-card has-background-white image is-128x128">
                                <p class="title has-text-dark">100</p>
                                <p>Projects</p>
                              </figure>
                            </article>
                          </div>
                        </div>
                      </div>
                    </div>
                {{-- </p> --}}
              </div>
            </nav>
        </div>
      </div>
    </section>

<div class="container"> 
    <div class="section">
       @yield('profile_content')
    </div>
</div>
@endsection

