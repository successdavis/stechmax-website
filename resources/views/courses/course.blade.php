<div class="cell medium-6 large-3 ">
    <a href="{{$course->path()}}">
        <div class="card course">
          <div class="course__image">
            <img src="{{$course->thumbnail_path}}">
          </div>
          <div class="card-section course__meta-information grid-x">
            <span class="cell">Type: Course</span>
          </div>
          <div class="card-section course__title">
            <h5>{{$course->title}}</h5>
          </div>
          <div class="card-section course__difficulty">
              {{$course->difficulty->level}}
          </div>
          <div class="card-section course__fee">
              &#8358; {{$course->getAmount()}}
          </div>
        </div>
    </a>
</div>
