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
								<p class="title"><span>&#8358</span>{{number_format($employee->thisMonthNetEarning(), 2)}}</p>
							</div>
						</div>
					</div>
					<footer class="card-footer">
						<div class="card-footer-item">
							<p class="subtitle">Gross Earning: <span>&#8358</span> {{number_format($employee->thisMonthGrossEarning()), 2}}</p>
						</div>
					</footer>
				</div>
			</div>
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="subtitle mb-2">Balance</h2>
						</div>
						<div class="level is-mobile">
							<div class="level-item has-widget-icon">
								<p class="title"><span>&#8358</span>{{$employee->earningBalance()}}</p>
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
								<p class="title"><span>&#8358</span>{{number_format($employee->lastMonthEarning(), 2)}}</p>
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
							<h2 class="title mb-2">Transactions</h2>
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
				</div>
			</div>
			<div class="tile is-parent">
				<div class="card is-card-widget tile is-child ">			
					<div class="card-content">
						<div class="">
							<h2 class="title mb-2">Method of Payment</h2>
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
									@if($bankdetails)
										<p>{{$bankdetails->account_number}}</p>
										<p>{{$bankdetails->bank_name}}</p>
										<p>{{$bankdetails->account_name}}</p>
										<p>{{$bankdetails->account_type}}</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="columns">
			<div class="column">
				<table class="table">
					<tr>
						<th>Basic Salary</th>
						<td><span>&#8358</span> {{number_format($employee->paygrade->basic, 2)}}</td>
					</tr>
					<tr>
						<th>Grade Level</th>
						<td>{{$employee->paygrade->name}}</td>
					</tr>
					<tr>
						<th>Job Title(s)</th>
						<td>{{$employee->user->getRoleNames()}}</td>
					</tr>
					<tr>
						<th>Department</th>
						<td>{{$employee->department->name}}</td>
					</tr>
				</table>
				<user-position :employee="{{$employee}}"></user-position>
			</div>
			<div class="column">
				<h3>Unpaid Payrolls</h3>
				<unpaid-payrolls :employee="{{$employee}}"></unpaid-payrolls>
			</div>
		</div>

		<user-permissions :user="{{$employee->user}}"></user-permissions>
    </div>
</div>
@endsection