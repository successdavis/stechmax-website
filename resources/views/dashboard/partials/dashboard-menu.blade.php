<div class="has-text-centered has-text-white">
  <img src="{{auth()->user()->avatar_path}}" class="thumbnail--medium mt-2">
  <p class="mb-reset has-text-centered has-text-white">Hello {{auth()->user()->f_name . ' ' . auth()->user()->l_name}}</p>
  <div class="mb-2">{{auth()->user()->user_id}}</div>
  <div class="mb-2">
      <span class="thumbnail--icon dark-gray">
        <a href="{{route('profile.show', ['user' => auth()->user()->email])}}">
          <i class="fas fa-user-tie" title="Access your profile here" style="color: white"></i>
        </a>
      </span>
    <span class="thumbnail--icon dark-gray">
      <a href="{{route('update.settings.edit')}}">
        <i class="fas fa-cogs" title="Apply Changes to your profile " style="color: white"></i>
      </a>
    </span>
    <span class="thumbnail--icon dark-gray">
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <!-- {{ __('Logout') }} -->
      <i class="fas fa-power-off" title="End your login Session " style="color: red"></i>
      </a>
    </span>
  </div>
</div>

<p style="padding: .5em 1em; width: 105%;" class="has-text-white has-background-black-ter">Dashboard</p>
<aside class="menu aside ">
  <p class="menu-label has-text-white">
    Dashboard
  </p>
  {{-- <ul class="menu-list">
    <li><a>Dashboard</a></li>
    <li><a>Customers</a></li>
  </ul> --}}
  <p class="menu-label">
    GENERAL
  </p>

  <ul class="menu-list has-text-white">
    <li><a class="has-icon has-text-grey-lighter">
        <span class="icon has-update-mark"><i class="fas fa-folder-open"></i></span>
        <span class="menu-label-item">My Courses</span>
      </a>
    </li>
    <li><a class="has-icon has-text-grey-lighter">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">Billing</span>
        </a>
    </li>
    <li><a class="has-icon has-text-grey-lighter">
            <span class="icon"><i class="fas fa-tag"></i></span>
            <span class="menu-label-item">My Payments</span>
        </a>
    </li>



@if (Auth::user()->isAdmin())
  <p class="menu-label">
    ADMIN CONTROL
  </p>
    <menu-dropdown name="Course Management">
      <li><a class="has-icon has-text-white">
            <span class="icon"><i class="fas fa-video"></i></span>
            <span class="menu-label-item">Create Course</span>
          </a>
      </li>
      <li><a class="has-icon has-text-white">
            <span class="icon"><i class="fas fa-pen-alt"></i></span>
            <span class="menu-label-item">Update Course</span>
          </a>
      </li>
    </menu-dropdown>
    <menu-dropdown name="Users">
      <li><a href="{{route('manage_user.index')}}" class="has-icon has-text-white">
              <span class="icon"><i class="fas fa-users"></i></span>
              <span class="menu-label-item">View all Users</span>
          </a>
      </li>
      <li><a class="has-icon has-text-white">
            <span class="icon"><i class="fas fa-id-card-alt"></i></span>
            <span class="menu-label-item">Active Permit Card</span>
          </a>
      </li>
    </menu-dropdown>
    <menu-dropdown name="Cashier">
      <li>
          <a class="has-icon has-text-white">
            <span class="icon"><i class="far fa-credit-card"></i></span>
            <span class="menu-label-item">Create Invoice</span>
          </a>
      </li>
      <li>
        <a class="has-icon has-text-white">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">View Invoice</span>
        </a>
      </li>
      <li>
        <a class="has-icon has-text-white">
          <span class="icon"><i class="fas fa-money-bill-wave"></i></span>
          <span class="menu-label-item">Add Payment</span>
        </a>
      </li>
    </menu-dropdown>
    <menu-dropdown name="Projects">
      <li>
        <a class="has-icon has-text-white">
          <span class="icon"><i class="fab fa-servicestack"></i></span>
          <span class="menu-label-item">Submit Project</span>
        </a>
      </li>
      <li>
        <a class="has-icon has-text-white">
          <span class="icon"><i class="fas fa-project-diagram"></i></span>
          <span class="menu-label-item">Pending Projects</span>
        </a>
      </li>
      <li>
        <a class="has-icon has-text-white">
          <span class="icon"><i class="fas fa-tasks"></i></span>
          <span class="menu-label-item">Completed Project</span>
        </a>
      </li>
    </menu-dropdown>
@endif
</aside>