<div class="streamer">
	<div class="cell medium-7 large-9 streamer__banner has-overlay">
		<div class="overlay"></div>
		<div class="overlay__content">
			<p class="overlay__content overlay__content--head">Welcome! What will you like to learn today?</p>
		</div>
	</div>
{{-- 	<div class="medium-5 large-3 show-for-medium">

		@foreach ($streamerCourses as $course)		
		<div class="grid-x grid-padding-x streamer__courses--card">
			<div class="cell align-middle medium-4 center-elements card-sibling card-sibling--primary">
				<div class="mt-2 white">{{$course->subject->name}}</div>
				{{-- The coment line of code below is to help me remember how to display image from storage --}}
				{{-- <img class="thumbnailmedium" src="{{asset('storage/thumbnails/default.jpg')}}"> --}}
				<img class="thumbnail--medium" src="{{$course->thumbnail_path}}">
				<p class="center-text white">{{$course->difficulty->level}} Difficulty</p>
			</div>
			<div class="cell align-middle medium-8 card-sibling card-sibling--secondary has-overlay ">
				<div class="overlay showOnHover"></div>
				<div class="overlay__content overlay__content--hover content__fadeIn--bottom">
					<a href="" class="overlay__content--head "><i class="far fa-play-circle"></i>Play</a>
				</div>
				<p class="mt-2"><strong>{{$course->title}}</strong></p>
				<p>{{$course->sypnosis}} ...
				</p>
				<div class="grid-x full-width">
					<div class="medium-6">
						<p>15 Lessons</p>
					</div>
					<div class="medium-6">
						2:22:51hrs
					</div>
				</div>
			</div>
		</div>

		@endforeach
	</div> --}}
</div>