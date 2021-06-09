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

            <div class="columns is-multiline">
                @foreach ($course->requirements as $requirement)
                    <li class="column "><i class="fas fa-plus"></i> {{$requirement->body}}</li>
                @endforeach
            </div>
            <hr>

            <div>
                <h5 class="is-size-5 mb-2"><strong>Course Description</strong></h5>
                <p class="double-line-height">{!! nl2br($course->description) !!}</p>
            </div>
        </div>
        <div class="column is-3">
            <div class="is-size-5 mb-2"><strong>Course Content</strong></div>
            <div>
                @include("courses.partials._coursetableofcontent")
            </div>
        </div>
    </div>
</div>