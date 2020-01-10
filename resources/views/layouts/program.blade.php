
<section class="bg-primary pb-2">
    <div class="grid-container">
        <p class="text-center pt-3 text-white">Your Dream Job is wating for you!</p>
        <h3 class="text-center pb-3 text-white">START A CAREER PROGRAMME</h3>
        <div class="grid-container">
            <div class="grid-x grid-margin-x small-up-1 medium-up-3">
                @foreach($programs as $program)
                    <div class="cell">
                        <div class="card" style="width: 300px;">
                          <img src="{{$program->thumbnail_path}}">
                          <div class="card-section">
                            <h4>{{$program->title}}</h4>
                            <p>{{$program->sypnosis}}</p>
                          </div>
                          <div class="grid-x card-section">
                              <div class="medium-7">
                                  <a href="{{$program->path()}}" class="button large">LETS BEGIN</a>
                              </div>
                              <div class="medium-5">
                                  <h5>  &#8358; {{$program->getAmount()}}</h5>
                              </div>
                          </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

