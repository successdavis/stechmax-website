@extends('layouts.app')

@section('head')
	<script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('body-close')
	<script>
	  // grecaptcha.ready(function() {
	  //     grecaptcha.execute('6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM', {action: 'homepage'}).then(function(token) {
	  //     	window.App.token = token
	  //     });
	  // });
	  
	</script>
@endsection

@section('content')
	<input type="hidden" name="token" id="token" value="">
<div class="has-overlay background">
	<div class="overlay"></div>
	<div class="container">
		<div class="section">
			<div class="site-reg-page">
				<div class="columns">
					<div class="column">
					    <site-registration mode="register"></site-registration>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

