<div class="cell medium-6 large-3 ">
    <a href="{{$course->path()}}">
        <div class="card course">
          <div class="course__image">
            <img src="{{asset('storage/course/' . $course->img)}}">
          </div>
          <div class="card-section course__meta-information grid-x">
            <span class="cell">Type: Track</span>
          </div>
          <div class="card-section course__title">
            {{$course->title}}
          </div>
          <div class="card-section course__difficulty">
              {{$course->difficulty}}
          </div>
          <div class="card-section course__fee">
            N{{$course->fee}}
          </div>
        </div>
    </a>
</div>

