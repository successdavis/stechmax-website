{{-- Title bar for Mobile Display --}}

 <div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
  {{-- <button class="menu-icon" type="button" data-toggle="responsive-menu"></button> --}}

  {{-- button to toggle offcanvas on small screen --}}
  <button type="button" class="menu-icon" data-toggle="offCanvasLeftOverlap"></button>

  <div class="title-bar-title">
    <a class="navbar-brand" style="color: white" href="{{ url('/') }}">
        {{-- {{ config('app.name', 'STECHMAX') }} --}}
          <img style="width: 120px;" src="{{ asset('storage/site-images/logo.png') }}">
    </a>
  </div>
</div>



{{-- Title bar for desktop and wide screen --}}
<div class="top-bar" id="responsive-menu">
  <div class="top-bar-left">

    <ul class="dropdown menu" data-dropdown-menu>
      <li>
        <a class="menu-text" href="{{ url('/') }}">
          {{-- {{ config('app.name', 'STECHMAX') }} --}}
          <img style="width: 120px;" src="{{ asset('storage/site-images/logo.png') }}">
        </a>
      </li>

      {{-- courses menu button --}}
      <li>
        {{-- <mega-menu></mega-menu> --}}
      </li>

      <li><a href="{{ url('/threads') }}">FORUM</a></li>
      <li>
        <input type="search" name="q" placeholder="Search catalogue" class="animated-search-form">
      </li>

    </ul>
  </div>

  {{-- content to the right of the title-bar for wide screen --}}
  <div class="top-bar-right">
    <ul class="menu">
    @guest
      <li><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __(' Login') }}</a></li>
      <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
    </ul>
    @else
    <li><a><i class="far fa-envelope"></i></a></li>
    <user-notifications></user-notifications>
    <li><a class="no-padding">
        <div class="profile-card-avater">
            <img src="{{auth()->user()->avatar_path}}" class="avater-image"  data-toggle="user_profile-menu">
        </div>
        <div class="dropdown-pane" id="user_profile-menu" data-position="bottom" data-alignment="right" data-dropdown>
            <ul>
                <li><a href="/profiles/{{Auth::user()->username}}">{{ Auth::user()->f_name . ' ' . Auth::user()->l_name }}</a></li>
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </a></li>
    @endguest
  </div>
</div>
{{-- <portal-target name="mega-menu-content"></portal-target> --}}
