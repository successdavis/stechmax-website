@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="bg-white">   
    <div class="section">
        <div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="title mb-2">Transactions</h2>
						</div>
						<div class="level is-mobile">
							<div class="level-item has-widget-icon">
								<div class="is-widget-icon">
									<span class="icon has-text-primary is-large">
										<i class="mdi mdi" style="font-size: 5em"></i>
									</span>
								</div>
							</div>
							<div class="level-item">
								<div class="is-widget-label">
									<h3 class="subtitle is-spaced"> Students </h3>
									<h1 class="title"><div> </div></h1>
								</div>
							</div>
						</div>
					</div>
					<footer class="card-footer">
						<div class="card-footer-item">
							<a href="">MANAGE PAYMENT METHOD</a>
						</div>
					</footer>
				</div>
			</div>
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="title mb-2">How you get paid</h2>
						</div>
						<div class="level is-mobile">
							<div class="level-item has-widget-icon">
								<div class="is-widget-icon">
									<span class="icon has-text-primary is-large">
										<i class="mdi mdi-bank" style="font-size: 5em"></i>
									</span>
								</div>
							</div>
							<div class="level-item">
								<div class="is-widget-label">
									<h3 class="subtitle is-spaced"> Wire transfer to bank account </h3>
									<p>{{auth()->user()->getShortMaskAccout()}}</p>
								</div>
							</div>
						</div>
					</div>
					<footer class="card-footer">
						<div class="card-footer-item">
							<a href="{{route('bank.index', ['user' => auth()->user()->username])}}">MANAGE PAYMENT METHOD</a>
						</div>
					</footer>
				</div>
			</div>

		</div>
    </div>
</div>
@endsection