<h3>Course Content</h3>
<div class="columns">
    <ul class="accordion" data-accordion data-accordion data-multi-expand="true">
        @foreach ($course->getSections() as $index => $section)
            <li class="accordion-item is-active" data-accordion-item>
                <a class="front-end-section relative-body" href="accordion-title"><i class="far fa-file-alt"></i> <strong>Section {{$index + 1}}: </strong>{{$section->title}} <i class="fas fa-long-arrow-alt-down top-right-button"></i></a>
                <div class="accordion-content" data-tab-content>
                    @foreach ($section->lectures as $topic)
                        <div class="front-end-course"><i class="far fa-play-circle"></i> {{$topic->title}}</div>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
</div>