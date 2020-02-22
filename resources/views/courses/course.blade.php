<div class="column is-3">
    <div class="card">
      <div class="card-image">
        <figure class="image is-4by3">
          <img img src="{{$program->thumbnail_path}}" alt="{{$program->title}}">
        </figure>
      </div>
      <div class="card-content">
        <div class="content">
          <h4>{{$program->title}}</h4>
          <p>{{$program->sypnosis}}</p>
        </div>
      </div>
      <footer class="card-footer">
        <a href="#" class="card-footer-item">Add to Wish</a>
        <a href="{{$program->path()}}" class="card-footer-item">LETS BEGIN</a>
      </footer>
    </div>
</div>






{{-- <div class="cell medium-6 large-3 ">
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
 --}}