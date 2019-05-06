<div class="align-content__center">
    <img src="{{auth()->user()->avatar_path}}" class="thumbnail--medium mt-2">
    <p class="mt-1">Hello {{auth()->user()->f_name . ' ' . auth()->user()->l_name}}</p>
    <div class="mb-2">
        <span class="thumbnail--icon dark-gray">
          <a href="{{route('profile.show', ['user' => auth()->user()->email])}}">
            <i class="fas fa-user-tie" title="Access your profile here"></i>
          </a>
        </span>
      <span class="thumbnail--icon dark-gray">
        <i class="fas fa-cogs"></i>
      </span>
      <span class="thumbnail--icon dark-gray">
        <i class="fas fa-power-off"></i>
      </span>
    </div>
</div>


{{-- <div class="grid-x grid-padding-x mt-2">
  <div class="small-4">
  </div>
  <div class="small-8 auto">
    <div>{{ucfirst(auth()->user()->f_name) . ' ' . ucfirst(auth()->user()->l_name)}}
      <br><strong>Role:</strong> Admin
    </div>
  </div>
</div> --}}

<ul class="white vertical menu accordion-menu" id="off-canvas_panel-links" data-accordion-menu>
    <li class="dark-gray"><a href="/home">Dashboard</a></li>
    <li><a href="/home/{{Auth::user()->email}}/courses">My Courses</a></li>
   
    @if (Auth::user()->isAdmin())

      <li>
        <a href="#">Manage Course</a>
        <ul class="menu vertical nested">
          <li><a href="{{route('courses.create')}}">Create Course</a></li>
          <li><a href="#">Manage Course</a></li>
        </ul>
      </li>

      <li>
        <a href="#">Manage Student</a>
        <ul class="menu vertical nested">
            <li><new-user :modal="'regModal'" ></new-user></li>
          <li><a href="{{route('manage_user.index')}}">View Users</a></li>
        </ul>
      </li>

    @endif


    <li>
      <a href="#">Fee</a>
      <ul class="menu vertical nested">
        <li><a href="#">Pay Fee</a></li>
        <li><a href="#">View all Payments</a></li>
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
    <li><a href="#">Settings</a></li>
</ul>

