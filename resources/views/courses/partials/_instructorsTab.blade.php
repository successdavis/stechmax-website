{{-- Course Instructors Tab --}}
        <div class="tabs-panel" id="Course_instructors_tab">
            <p>This section is still under development</p>
        </div>
        @if (auth()->check() && $course->isSubscribedBY(auth()->user()))
            <div class="tabs-panel" id="Course_materials_tab">
                <p>In here you will find PDF materials to this course</p>
            </div>
            <div class="tabs-panel" id="Course_questions_tab">
                <p>There are no questions at the moment</p>
            </div>
        @endif