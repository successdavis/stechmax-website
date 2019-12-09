<div class="tabs-panel is-active" id="course_content_tab">
            <div class="grid-x grid-padding-x">
                <div class="cell medium-8 double-line-height ">
                    <h5><strong>What you will learn</strong></h5>
                    <div class="grid-container">
                        <div class="grid-container">
                            <ul class="grid-x grid-padding-x">
                                @foreach ($course->learns as $learn)
                                    <li class="medium-6">{{$learn->body}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <h5><strong>Course Requirement(s)</strong></h5>
                    <div class="grid-container">
                        <div class="grid-container">
                            <ul class="grid-x grid-padding-x double-line-height ">
                                @foreach ($course->requirements as $requirement)
                                    <li class="medium-6">{{$requirement->body}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h5><strong>Course Description</strong></h5>
                        <p class="double-line-height">{{$course->description}} </p>
                    </div>
                </div>
                <div class="cell medium-4">
                    @include('courses.partials._content')
                </div>
            </div>
        </div>