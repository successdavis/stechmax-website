<nav-bar inline-template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand is-flex-touch justify-content-touch" style="justify-content: space-between;">

      <a @click.prevent="drIsOpen = !drIsOpen" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>

      <a class="navbar-item" href="{{ url('/') }}">
        <img src="{{ asset('storage/site-images/logo.png') }}" width="112" height="28">
      </a>

      <a class="navbar-item is-hidden-desktop" href="{{ route('login') }}">Login</a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        {{-- <a class="navbar-item">
          Home
        </a> --}}
        <mega-menu></mega-menu>
        <a class="navbar-item" href="{{ url('/threads') }}">
          FORUM
        </a>
        <a class="navbar-item" href="{{ url('/pricing') }}">
          PRICING
        </a>

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            QUICK LINKS
          </a>

          <div class="navbar-dropdown">
            <a href="/studentshowcase" class="navbar-item">
              Student Showcase
            </a>
            <a class="navbar-item">
              Upcoming Events
            </a>
            <a class="navbar-item">
              Contact
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item">
              Report an issue
            </a>
          </div>
        </div>
      </div>

      <div class="navbar-end has-divider">
        @if (auth()->check())

          <a title="Updates" class="navbar-item has-divider is-desktop-icon-only">
            <user-notifications></user-notifications>
            {{-- <span class="icon has-update-mark"><i class="fas fa-bell default"></i></span> --}}
          </a>
          <hr class="navbar-divider">
          <div class="navbar-item has-dropdown has-divider is-hoverable">
            <a class="navbar-link">
              <figure class="is-user-avatar image is-24x24" style="margin-right: .75rem;">
                <img class="is-rounded" 
                  src="{{auth()->user()->avatar_path}}" 
                  alt="{{auth()->user()->username}}">
              </figure>
              {{auth()->user()->username}}
            </a>

            <div class="navbar-dropdown">
              <a class="navbar-item" href="/profiles/{{Auth::user()->username}}">
                <span class="icon"><i class="fas fa-user"></i></span>
                <span>{{ Auth::user()->f_name . ' ' . Auth::user()->l_name }}</span>
              </a>
              <a class="navbar-item" href="{{route('dashboard')}}">
                <span class="icon"><i class="fas fa-angle-double-right"></i></span>
                <span>Dashboard</span>
              </a>
              <a class="navbar-item">
                <span class="icon"><i class="fas fa-cogs"></i></span>
                <span>Settings</span>
              </a>
              <a class="navbar-item" href="{{ route('logout') }}"onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();
              ">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                <span>Logout</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </a>
            </div>
          </div>
        @else
            <div class="navbar-item">
              <div class="buttons">
                <a href="{{ route('register') }}" class="button is-primary">
                  <strong>Sign up</strong>
                </a>
                <a href="{{ route('login') }}" class="button is-light">
                  <i class="fas fa-sign-in-alt"> </i> {{ __(' Login') }}
                </a>
              </div>
            </div>
        @endif
      </div>
    </div>

        <div v-if="drIsOpen" @click.prevent="drIsOpen = false" class="dr_overlay" v-cloak></div>

    <div :class="drIsOpen ? 'is-open' : 'not-open'" class="n_drawer open-left">
      <i @click.prevent="drIsOpen = false" class="fas fa-times n_drawer_close"></i>
      <div class="n_drawer-title">
          STECHMAX
      </div>
        <ul class="n_drawer_items">
          @if (Route::has('login'))
                <div class="mt-small">
                    @auth
                        <a class="button is-fullwidth mt-small" href="{{ url('/home') }}">Home</a>
                        <li class="n_drawer_items--child">
                            <span><i class="fas fa-store-alt"></i></span>
                            <a href="">PROFILE</a>
                        </li>
                        <li class="n_drawer_items--child">
                          <span><i class="fas fa-pen"></i></span>
                          <a href="/exams">DASHBOARD</a>
                        </li>
                    @endauth
                </div>
            @endif
            <li class="n_drawer_items--child">
              <span><i class="fas fa-pen"></i></span>
              <a href="{{ url('/courses') }}">LIBRARY</a>
            </li>
            <li class="n_drawer_items--child">
              <span><i class="fas fa-pen"></i></span>
              <a href="{{ url('/threads') }}">FORUM</a>
            </li>
            <li class="n_drawer_items--child">
              <span><i class="fas fa-pen"></i></span>
              <a href="{{ url('/pricing') }}">PRICING</a>
            </li>
            <li class="n_drawer_items--child">
              <span><i class="fas fa-pen"></i></span>
              <a href="/exams">QUICK LINKS</a>
            </li>
        </ul>
        {{-- <ask-question style="width: 100%"></ask-question> --}}
        @auth
        <a class="button is-fullwidth mt-small" href="{{ route('logout') }}" 
          onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"

        >{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else 

          <a class="button is-fullwidth mt-small" href="{{ route('login') }}">Login</a>

          @if (Route::has('register'))
              <a class="button is-fullwidth mt-small" href="{{ route('register') }}">Register</a>
          @endif
          </div>
        @endauth
    </div>
  </nav>
</nav-bar>
<portal-target name="megamenu"></portal-target>