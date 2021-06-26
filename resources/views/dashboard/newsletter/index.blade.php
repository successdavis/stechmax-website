@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')

<newsletter></newsletter>


<!-- <section class="container">
	<div class="section">
		<div class="columns is-3 is-multiline is-mobile">
			<div class="column is-8 bg-white">

					@foreach($newsletters as $newsletter)
						@if(view()->exists("dashboard.newsletter.channels.{$newsletter->type}"))
		                    @include ("dashboard.newsletter.channels.{$newsletter->type}", ['newsletter' => $newsletter])
						@endif
					@endforeach

			</div>
			<div class="is-4 column has-background-grey">
				Hello World
			</div>
		</div>
	</div>
</section> -->
@endsection