@extends('dashboard.partials.dashboardlayout')

@section('dashboardcontent')
<div class="bg-white">   
    <div class="section">
    	<p class="title">Earnings</p>
        <div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="subtitle mb-2">This Month</h2>
						</div>
						<div class="level is-mobile">
							<div class="level-item">
								<p class="title"><span>&#8358</span>{{number_format($netEarning, 2)}}</p>
							</div>
						</div>
					</div>
					<footer class="card-footer">
						<div class="card-footer-item">
							<p class="subtitle">Gross Earning: <span>&#8358</span> {{number_format($grossEarning), 2}}</p>
						</div>
					</footer>
				</div>
			</div>
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="subtitle mb-2">Unpaid Balance</h2>
						</div>
						<div class="level is-mobile">
							<div class="level-item has-widget-icon">
								<p class="title"><span>&#8358</span>{{$balance}}</p>
							</div>
						</div>
					</div>
					<footer class="card-footer">
						<div class="card-footer-item">
							<p class="subtitle">Next payment: 26th - 28th {{Carbon\Carbon::now()->format('M')}}</p>
						</div>
					</footer>
				</div>
			</div>
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="subtitle mb-2">Last Payment</h2>
						</div>
						<div class="level is-mobile">
							<div class="level-item has-widget-icon">
								<p class="title"><span>&#8358</span>{{number_format($lastMonthPayroll, 2)}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
        <div class="tile is-ancestor">
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="title mb-2">Payment History</h2>
						</div>
						<div class="level is-mobile">
							<table class="table">
								@foreach($transactions as $transaction)
									<tr>
										<td>{{$transaction->updated_at->format('M d Y')}}</td>
										<td><span>&#8358</span> {{number_format($transaction->gross_salary, 2)}}</td>
									</tr>
								@endforeach
							</table>
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
									<p>{{auth()->user()->employee->getMaskAccount()}}</p>
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

		<table class="table">
			<tr>
				<th>Basic Salary</th>
				<td><span>&#8358</span> {{number_format(auth()->user()->employee->paygrade->basic, 2)}}</td>
			</tr>
			<tr>
				<th>Grade Level</th>
				<td>{{auth()->user()->employee->paygrade->name}}</td>
			</tr>
			<tr>
				<th>Job Title(s)</th>
				<td>{{strtoupper (auth()->user()->getRoleNames())}}</td>
			</tr>
			<tr>
				<th>Department</th>
				<td>{{auth()->user()->employee->department->name}}</td>
			</tr>
		</table>
		<!-- <a class="button is-medium is-info" href="/paygrade/{{auth()->user()->id}}">Paygrade</a> -->
    </div>
</div>
@endsection