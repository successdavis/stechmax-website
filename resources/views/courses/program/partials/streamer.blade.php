<div class="program-header" style="background-image: url({{$course->thumbnail_path}})">
  <div class="overlay"></div>
  <div class="header-content">
     <div class="header-content__hero">{{$course->title}}</div>
     <p class="header-content__paragraph">{{$course->sypnosis}}</p>
     <a class="button subscribe-button" href="{{$course->path()}}/subscription?class=true">BEGIN YOUR TRAINING</a>
  </div>
</div>