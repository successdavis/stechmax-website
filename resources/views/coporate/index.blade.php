@extends('layouts.app')
@section('head')
	<script src="https://www.google.com/recaptcha/api.js?render=6LeawrcUAAAAAIrA-LQ-kytjPFEBcedXDLcWHHHM"></script>
@endsection

@section('pageTitle')
  Apply for Coporate/Special ICT Training
@endsection

@section('content')
	<input type="hidden" name="token" id="token" value="">

	<div class="container">
		<div class="section">
				<div class="columns">
					<div class="column is-three-fifths section" style="background: white">
						@auth
							<div>Please return to this page after signing in</div>
							<coporate-registration :subjects="{{$subjects}}"></coporate-registration>
						@else
						    <site-registration mode="register" loginroute="/coporate/registration"></site-registration>
						@endauth
					</div>
					<div class="column">
						<div class="content is-medium is-unselectable">
							<div class="is-size-4 mb-2"><strong>Organization Coporate Training</strong></div>

							<p>Our professional development courses make your company more competitive while giving your staff the skills the need to be more effective, productive and valued members of your organization. </p>
							<p>
								We offer a complete portfolio of IT Courses and certifications, based on best practices and standards. To stay flexible and time efficient, we deliver our training on e-learning and classroom instruction. With this method, you can take any lecture at your convienient.
							</p>
							<div class="is-size-4"><strong>Private Coporate Training</strong></div>
							<p>
								In today's world of ICT, it is imperative to stay inline with latest technologies and expose your professional self to knowledge and skills inputs. Yet your working hours and busy schedules will not allow you the extra time to attend classroom lectures, then this is the solution for you. Take your classes at your own convenience. 
							</p>
						</div>
					</div>
				</div>
		</div>
	</div>
@endsection