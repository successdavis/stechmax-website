<div class="grid-x grid-padding-x mt-2">
  <div class="small-4">
    <img src="{{asset('storage/avaters/default_avater.png')}}" class="avater-image">
  </div>
  <div class="small-8 auto">
    <div>{{ucfirst(auth()->user()->f_name) . ' ' . ucfirst(auth()->user()->l_name)}}
      <br><strong>Role:</strong> Admin
    </div>
  </div>
</div>


<ul class="vertical menu accordion-menu" data-accordion-menu>
    <li><a href="/home">Home</a></li>
    <li><a href="/home/{{Auth::user()->email}}/courses">My Courses</a></li>
   
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
