@extends('layouts.app')

@section('head')
	<script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('body-close')
	{{-- <script>
	  grecaptcha.ready(function() {
	      grecaptcha.execute('6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM', {action: 'homepage'}).then(function(token) {
	      	window.App.token = token
	      });
	  });
	  
	</script> --}}
@endsection

@section('content')
	<input type="hidden" name="token" id="token" value="">
<div class="has-overlay background">
	<div class="overlay"></div>
	<div class="container">
		<div class="section">
			<div class="site-reg-page">
				<div class="columns">
					<div class="column is-three-fifths">
					    <site-registration mode="register"></site-registration>
					</div>
					<div class="column">
						<div>
							<p class="center-text is-size-5 mt-2 mb-3">One Account for all Services</p>
						</div>
						<div class="columns has-text-centered is-size-5 is-multiline">
							<div class="column is-6 has-text-centered">
								<a href=""><i class="fas fa-book-open"></i></a>
								<p class="center-text">Projects</p>
							</div>
							<div class="column is-6 has-text-centered">
								<a href=""><i class="fas fa-store"></i></a>
								<p class="center-text">E-Store</p>
							</div>
							<div class="column is-6 has-text-centered">
								<a href="/threads"><i class="far fa-comments"></i></a>
								<p class="center-text">Forum</p>
							</div>
							<div class="column is-6 has-text-centered">
								<a href=""><i class="fas fa-copy"></i></a>
								<p class="center-text">Templates</p>
							</div>
							<div class="column mb-3 is-6 has-text-centered">
								<a href=""><i class="fas fa-school"></i></a>
								<p class="center-text">School</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

