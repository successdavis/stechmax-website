
<section class="bg-primary">
    <div class="grid-container">
        <h3 class="text-center mt-4 mb-4 text-white">ENROLL FOR A PROGRAMS</h3>

        <div class="grid-x grid-margin-x ">
            @foreach($programs as $program)
                <div class="card" style="width: 250px;">
                    <img class="mt-2 mb-2" src="{{asset('/storage/thumbnails/3_months_program.svg')}}">
                    <div class="card-divider center-text">
                        <h4>{{$program->title}}</h4>
                    </div>
                        <h3 class="center-text mt-2">&#8358;{{$program->amount}}</h3>
                    <div class="card-section">
                        @foreach($program->childrenCourses()->get() as $course)
                            <p class="center-text" title="{{$course->sypnosis}}">{{$course->title}}</p>
                        @endforeach

                        <a class="btn medium button primary expanded" href="{{$program->path()}}/register">LETS BEGIN</a>
                    </div>
                </div>
            @endforeach
        </div>
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

