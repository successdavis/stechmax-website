<ul class="tabs" data-tabs id="example-tabs">
    <div class="grid-container">
        <li class="tabs-title is-active"><a href="#course_content_tab" aria-selected="true">Content</a></li>
        <li class="tabs-title disable"><a data-tabs-target="Course_instructors_tab" href="#Course_instructors_tab">Instructors</a></li>
        @if (auth()->check() && $course->isSubscribedBy(auth()->user()))
            <li class="tabs-title"><a data-tabs-target="Course_materials_tab" href="#Course_materials_tab">Course Materials</a></li>
            <li class="tabs-title"><a data-tabs-target="Course_questions_tab" href="#Course_questions_tab">Questions</a></li>
        @endif
    </div>
</ul>

