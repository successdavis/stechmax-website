<div class="cell medium-6 large-3 ">
    <a href="{{$track->path()}}">
        <div class="card course">
          <div class="course__image">
            <img src="{{asset($track->thumbnail_path)}}">
          </div>
          <div class="card-section course__meta-information grid-x">
            <span class="cell">Type: Track</span>
          </div>
          <div class="card-section course__title">
            {{$track->title}}
          </div>
          <div class="card-section course__difficulty">
              {{$track->difficulty->level}}
          </div>
          <div class="card-section course__fee">
            &#8358; {{$track->getAmount()}}
          </div>
        </div>
    </a>
</div>

