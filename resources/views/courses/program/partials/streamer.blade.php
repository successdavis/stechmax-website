<div class="program-header" style="background-image: url({{$course->thumbnail_path}})">
  <div class="overlay"></div>
  <div class="header-content">
     <div class="header-content__hero">{{$course->title}}</div>
     <p class="header-content__paragraph">{{$course->sypnosis}}</p>
     <div class="buttons is-centered">
       <a class="button is-success is-medium" href="{{$course->path()}}/subscription?class=false">ENROLL FOR ONLINE</a>
       <a class="button is-success is-medium" href="{{$course->path()}}/subscription?class=true">ENROLL CLASSROOM</a>
     </div>
  </div>
</div>