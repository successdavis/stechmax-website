<div class="tile is-ancestor">
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title ">
					<span class="icon"><i class="fas fa-star-half-alt"></i></span>
					<span><b>Amount you Owe</b></span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content">
				<div class="level is-mobile">
					<div class="level-item">
						<div class="is-widget-label">
							<h3 class="subtitle is-spaced"> Amount </h3>
							<h1 class="title"><div>&#8358; {{auth()->user()->totalDebtForInvoices()}} </div></h1>
						</div>
					</div>
					<div class="level-item has-widget-icon">
						<div class="is-widget-icon">
							<span class="icon has-text-primary is-large">
								<i class="mdi mdi-cash"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tile is-parent">
		<div class="card is-card-widget tile is-child">
			<header class="card-header card-cen-v">
				<p class="card-header-title">
					<span class="icon"><i class="fas fa-code-branch"></i></i></span>
					<span>Total On Open Invoice</span>
				</p>
				<button type="button" class="button is-small align-sf-ct">
					<span class="icon"><i class="fas fa-history"></i></span>
				</button>
			</header>
			<div class="card-content">
				<div class="level is-mobile">
					<div class="level-item">
						<div class="is-widget-label">
							
							<h1 class="title"><div>&#8358; {{auth()->user()->getTotalAmountOfOpenInvoices()}} </div></h1>
						</div>
					</div>
					<div class="level-item has-widget-icon">
						<div class="is-widget-icon">
							<span class="icon has-text-info is-large">
								<i class="mdi mdi-cash-multiple"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>