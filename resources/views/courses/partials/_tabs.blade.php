<ul class="">
	<div>
		<tabs>
			<tab name="Overview" :selected="true">
				@include('courses.partials._contentTab')
			</tab>
			<tab name="Transcript">
				<span>Hi! We are working on this section</span>
			</tab>
			<tab name="Instructors">
				@include('courses.partials._instructorsTab')
			</tab>
			<tab name="Reviews">
				<div class="container">
					<course-review :course="{{$course}}"></course-review>
				</div>
			</tab>

			
	        {{-- @if (auth()->check() && $course->isSubscribedBy(auth()->user()))
	            <li class="tabs-title"><a data-tabs-target="Course_materials_tab" href="#Course_materials_tab">Course Materials</a></li>
	            <li class="tabs-title"><a data-tabs-target="Course_questions_tab" href="#Course_questions_tab">Questions</a></li>
	        @endif --}}
		</tabs>
	</div>
</ul>

