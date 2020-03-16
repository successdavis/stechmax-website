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