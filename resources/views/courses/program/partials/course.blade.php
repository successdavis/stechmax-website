<div class="medium-4 cell">
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
</div>