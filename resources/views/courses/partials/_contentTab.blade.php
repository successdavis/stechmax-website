<div class="container section">
    <div class="columns">
        <div class="column bg-white medium-8 double-line-height ">
            <h5 class="is-size-5 mb-2"><strong>What you will learn</strong></h5>
            <div class="columns is-multiline">
                @foreach ($course->learns as $learn)
                    <li class="column is-6"><i class="fas fa-plus"></i> {{$learn->body}}</li>
                @endforeach
            </div>
            <hr> 

            <h5 class="is-size-5 mb-2"><strong>Course Requirement(s)</strong></h5>

            <div class="columns is-mobile is-multiline">
                @foreach ($course->requirements as $requirement)
                    <li class="column"><i class="fas fa-plus"></i> {{$requirement->body}}</li>
                @endforeach
            </div>
            <hr>

            <div>
                <h5 class="is-size-5 mb-2"><strong>Course Description</strong></h5>
                <p class="double-line-height">{{$course->description}} </p>
            </div>
        </div>
        <div class="column is-3">
            <div class="is-size-5 mb-2"><strong>Course Content</strong></div>
            <div>
                
                @foreach ($sections as $section)
                    @if ($loop->first)
                        <collapse title="{{$section->title}}" :open="true">
                            @foreach ($section->lectures as $lecture)
                                <div class="columns is-multiline" slot="content">
                                    <div class="column is-narrow"><i class="fas fa-caret-right"></i></div>
                                    <div class="column">{{$lecture->title}}</div>
                                </div>
                            @endforeach
                        </collapse>
                        @continue
                    @endif

                    <collapse title="{{$section->title}}">
                            @foreach ($section->lectures as $lecture)
                                <div class="columns is-multiline" slot="content">
                                    <div class="column is-narrow"><i class="fas fa-caret-right"></i></div>
                                    <div class="column">{{$lecture->title}}</div>
                                </div>
                            @endforeach
                    </collapse>
                @endforeach
            </div>
        </div>
    </div>
</div>