{{-- <div class="column is-4">
  <a href="{{$curriculum->path()}}">
  <div class="card program-curriculum-item">
     <div class="program-card-content">
       <div class="card-divider">
         <h4>{{$curriculum->title}}</h4>
       </div>
       <img src="{{ asset($curriculum->thumbnailPath) }}">
       <div class="card-section">
         <p>{{$curriculum->sypnosis}}</p>
       </div> 
     </div>
     <img class="shadow" src="{{ asset('/images/shadow.png') }}">
  </div>
  </a>
</div> --}}


<div class="column is-3">
  <a href="{{$curriculum->path()}}">
    <div class="card program-curriculum-item">
      <div class="card-image">
        <figure class="image is-4by3">
          <img img src="{{ asset($curriculum->thumbnailPath) }}" alt="{{$course->title}}">
        </figure>
      </div>
      <div class="card-content">
        <div class="content">
        <div class="columns is-mobile">
          <div class="column">
            <span>{{$curriculum->difficulty->level}}</span>
          </div>
          <div class="column">
            <span>{{$curriculum->type->name}}</span>
          </div>
        </div>
          <h4>{{$curriculum->title}}</h4>
        </div>
      </div>
    </div>
        {{-- <img class="shadow" src="{{ asset('/images/shadow.png') }}"> --}}
  </a>
</div>