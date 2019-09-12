@extends('layouts.app')

@section('head')
	<script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('body-close')
	<script>
	  grecaptcha.ready(function() {
	      grecaptcha.execute('6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM', {action: 'homepage'}).then(function(token) {
	      	window.App.token = token
	      });
	  });
	  
	</script>
@endsection

@section('content')
	<input type="hidden" name="token" id="token" value="">
    <site-registration></site-registration>
@endsection

