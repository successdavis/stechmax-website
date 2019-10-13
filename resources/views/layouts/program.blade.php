
<section class="bg-primary pb-2">
    <div class="grid-container">
        <h3 class="text-center pt-1 pb-1 text-white">ENROLL FOR A PROGRAMS</h3>
            @foreach($programs as $program)
                <div class="card" style="width:360px;">
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
                          <h3>  &#8358; {{$program->getAmount()}}</h3>
                      </div>
                  </div>
                  <h4 class="text-center">Lessons</h4>
                    <div class="card-section">
                        @foreach($program->childrenCourses()->get() as $course)
                            <p title="{{$course->sypnosis}}"><i class="fas fa-train"></i> | {{$course->title}}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach
    </div>
</section>


{{--<section class="bg-primary">--}}
    {{--<div class="grid-container">--}}
        {{--<h3 class="text-center mt-4 mb-4 text-white">ENROLL FOR A PROGRAMS</h3>--}}

        {{--<div class="grid-x grid-margin-x ">--}}
        {{--<div class="card" style="width: 250px;">--}}
            {{--<img class="mt-2 mb-2" src="{{asset('/storage/thumbnails/3_months_program.svg')}}">--}}
            {{--<div class="card-divider center-text">--}}
                {{--<h4 >CERTIFICATE IN COMPUTER</h4>--}}
            {{--</div>--}}
                {{--<h3 class="center-text mt-2">&#8358;10,000</h3>--}}
            {{--<div class="card-section">--}}
                {{--<p class="center-text" title="Learn the History and know how every component fit it">Computer Fundamentals</p>--}}
                {{--<p class="center-text" title="Master CorelDraw beginner to Expert">CorelDraw</p>--}}
                {{--<p class="center-text" title="Master Microsoft Word Beginner to Expert">Microsoft Word</p>--}}
                {{--<p class="center-text" title="Master Microsoft Excel Beginner to Expert">M.S Excel</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">M.S PowerPoint</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">Internet</p>--}}

                {{--<a class="btn medium button primary expanded" href="/certificate">LETS BEGIN</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card card-recommended" style="width: 300px;">--}}
            {{--<span class="card__recommended--text">Recommended</span>--}}
            {{--<img class="mt-2 mb-2" src="{{asset('/storage/thumbnails/6_months_program.svg')}}">--}}
            {{--<div class="card-divider center-text">--}}
                {{--<h4>DIPLOMA IN COMPUTER</h4>--}}
            {{--</div>--}}
                {{--<h3 class="center-text mt-2">&#8358;18,000</h3>--}}
            {{--<div class="card-section">--}}
                {{--<p class="center-text" title="Learn the History and know how every component fit it">Computer Fundamentals</p>--}}
                {{--<p class="center-text" title="Master CorelDraw beginner to Expert">CorelDraw</p>--}}
                {{--<p class="center-text" title="Master Microsoft Word Beginner to Expert">Microsoft Word</p>--}}
                {{--<p class="center-text" title="Master Microsoft Excel Beginner to Expert">M.S Excel</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">M.S PowerPoint</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">Data Communication & Internet</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">M.S. Access</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">Adobe Photoshop</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">Adobe Illustrator</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">M.S. DOS</p>--}}
                {{--<p class="center-text" title="Master Microsoft PowerPoint Beginner to Expert">PAGE MAKER</p>--}}

                {{--<a class="btn medium button primary expanded" href="/certificate">LETS BEGIN</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card" style="width: 300px;">--}}
            {{--<img class="mt-2 mb-2" src="{{asset('/storage/thumbnails/shield.svg')}}">--}}
            {{--<div class="card-divider center-text">--}}
                {{--<h4>CUSTOM PROGRAM</h4>--}}
            {{--</div>--}}
            {{--<div class="card-section">--}}
                {{--<p class="center-text" title="Learn the History and know how every component fit it">Here you get to manually choose the courses you wish to learn</p>--}}

                {{--<a class="btn medium button primary expanded" href="/certificate">LETS BEGIN</a>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card" style="width: 300px;">--}}
            {{--<img class="mt-2 mb-2" src="{{asset('/storage/thumbnails/shield.svg')}}">--}}
            {{--<div class="card-divider center-text">--}}
                {{--<h4>SPECIAL TRAINING</h4>--}}
            {{--</div>--}}
            {{--<div class="card-section">--}}
                {{--<p>Recommended for those with busy schedules and will want to study at their free time.</p>--}}
                {{--<p>Study Certificate in Computer from anywhere</p>--}}
                {{--<p>Study Diploma in Computer from anywhere</p>--}}


                {{--<a class="btn medium button primary expanded" href="/certificate">LETS BEGIN</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}

