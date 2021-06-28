<div class="has-text-centered has-text-white">
  <img src="{{auth()->user()->avatar_path}}" class="thumbnail--medium mt-2">
  <p class="mb-reset has-text-centered has-text-white">Hello {{ Ucwords( auth()->user()->f_name) }}</p>
  @if(!auth()->user()->isEmployee())
    <div class="mb-2">{{auth()->user()->user_id}}</div>
  @else
  <p class="mb-reset has-text-centered has-text-white">{{ strtoupper (auth()->user()->getRoleNames() )}}</p>
  <p class="is-small has-text-centered has-text-white">Dept. {{ ucwords (auth()->user()->employee->department->name )}}</p>
  @endif
  <div class="mb-2">
      <span class="thumbnail--icon dark-gray">
        <a href="{{route('profile.show', ['user' => auth()->user()->username])}}">
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
  <a href="/dashboard" class="menu-label has-text-white">
    Dashboard
  </a>
  {{-- <ul class="menu-list">
    <li><a>Dashboard</a></li>
    <li><a>Customers</a></li>
  </ul> --}}
  <p class="menu-label">
    GENERAL
  </p>

  <ul class="menu-list has-text-white">
    <li><a href="{{route('mycourses.index', ['user' => auth()->user()->username])}}" class="has-icon has-text-grey-lighter">
        <span class="icon has-update-mark"><i class="fas fa-folder-open"></i></span>
        <span class="menu-label-item">My Courses</span>
      </a>
    </li>
    @if(!auth()->user()->isEmployee())
    <li><a href="{{route('billing.home')}}" class="has-icon has-text-grey-lighter">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">Billing</span>
        </a>
    </li>
    @else
      <li><a href="{{route('employee.index', ['user' => auth()->user()->username])}}" class="has-icon has-text-grey-lighter">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">Payment</span>
        </a>
      </li>
    @endif


    @if (Auth::user()->isAdmin())
      <p class="menu-label">
        ADMIN CONTROL
      </p>
        <menu-dropdown name="Course Management">
          <li><a href="{{route('courses.create')}}" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-video"></i></span>
                <span class="menu-label-item">Create Course</span>
              </a>
          </li>
          <li><a href="{{route('courses.index')}}" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-pen-alt"></i></span>
                <span class="menu-label-item">All Courses</span>
              </a>
          </li>
        </menu-dropdown>
        <menu-dropdown name="Users">
          <li><a href="{{route('manage_user.index')}}" class="has-icon has-text-white">
                  <span class="icon"><i class="fas fa-users"></i></span>
                  <span class="menu-label-item">View all Users</span>
              </a>
          </li>
          <li><a href="{{route('permitcards')}}" target="_blank" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-id-card-alt"></i></span>
                <span class="menu-label-item">Active PMT Cards</span>
              </a>
          </li>
          <li><a href="{{route('user_rankings')}}" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-id-card-alt"></i></span>
                <span class="menu-label-item">Rankings</span>
              </a>
          </li>
        </menu-dropdown>

        @can('manage invoice')
          <menu-dropdown name="Cashier">
            <li>
                <a href="{{route('manage_invoice.create', ['user' => auth()->user()->username])}}" class="has-icon has-text-white">
                  <span class="icon"><i class="far fa-credit-card"></i></span>
                  <span class="menu-label-item">Create Invoice</span>
                </a>
            </li>
            <li>
              <a href="{{route('manage_invoice.addpayment')}}" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-money-bill-wave"></i></span>
                <span class="menu-label-item">Manage Invoice</span>
              </a>
            </li>
            <li>
              <a href="{{route('manage_invoice.index', ['user' => auth()->user()->username])}}" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-receipt"></i></span>
                <span class="menu-label-item">Invoices</span>
              </a>
            </li>
            @can('review financial records')
            <li>
              <a href="{{route('payment.index')}}" class="has-icon has-text-white">
                <span class="icon"><i class="fas fa-receipt"></i></span>
                <span class="menu-label-item">Payments</span>
              </a>
            </li>
            @endcan
          </menu-dropdown>
        @endcan

        <li><a href="{{route('newsletter.index')}}" class="has-icon has-text-grey-lighter">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">News Letter</span>
        </a>
        </li>


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
        <li><a href="{{route('client.index')}}" class="has-icon has-text-grey-lighter">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">Clients</span>
        </a>
        <li><a href="{{route('employee.list')}}" class="has-icon has-text-grey-lighter">
          <span class="icon"><i class="fas fa-receipt"></i></span>
          <span class="menu-label-item">Employees</span>
        </a>
    </li>
    @endif
  </ul>
</aside>
