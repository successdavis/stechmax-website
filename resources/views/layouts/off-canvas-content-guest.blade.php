<ul class="vertical menu accordion-menu" data-accordion-menu>
    <li><a href="{{ url('/courses') }}" data-toggle="library-dropdown">LIBRARY  <i class="fas fa-angle-double-down"></i></a></li>
    <li><a href="{{ url('/threads') }}">FORUM</a></li>
    
    <li><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __(' Login') }}</a></li>
    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
    
    {{-- <li>
      <a href="#">Courses</a>
      <ul class="menu vertical nested">
        <li><a href="#">My Courses</a></li>
        <li><a href="#">Completed Courses</a></li>
      </ul>
    </li>

    <li>
      <a href="#">Payments</a>
      <ul class="menu vertical nested">
        <li><a href="#">My Courses</a></li>
        <li><a href="#">Completed Courses</a></li>
      </ul>
    </li>

    <li>
      <a href="#">Projects</a>
      <ul class="menu vertical nested">
        <li><a href="#">Course Project</a></li>
        <li><a href="#">Showcase</a></li>
      </ul>
    </li>

    <li><a href="#">Payments</a></li>
    <li><a href="#">Notification</a></li>
    <li><a href="#">Settings</a></li> --}}
</ul>
