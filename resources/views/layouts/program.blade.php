<div class="container">
  <div>
    <div class="has-text-centered">
        <p class="is-size-3 has-text-centered">Your Dream Job is wating for you!</p>
        <h3 class="is-size-4 pb-3">START A CAREER PROGRAMME</h3>
    </div>
    <div class="columns is-multiline">
        @foreach($programs as $program)
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
        @endforeach
    </div>
  </div>
</div>

