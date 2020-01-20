<!DOCTYPE html>
<html>
<head>
	<title>Active Users</title>
</head>
<style type="text/css">
	<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;

    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
</style>
</style>
<body>
	@foreach ($subscriptions as $subscription)
		
		<table width="100%">
			<tr>
				<td>
					<img src="{{$subscription->owner->passport_path}}" style="width: 120px; height: 120px; border-radius:" alt="" width="150"/>
		        	<h3>ID No: {{$subscription->owner->user_id}} </h3>
				</td>
				<td align="left" style="vertical-align: top; line-height: 1.2em;">
					<h1>{{ucwords($subscription->owner->f_name.' '.$subscription->owner->m_name.' '.$subscription->owner->l_name)}}</h1>
					<table>
						<tr>
							<td>Gender: {{ ucfirst($subscription->owner->gender) }}</td>
							<td>Date Joined: {{$subscription->owner->date_joined()}}</td>
						</tr>
						<tr>
							<td>Email: {{ $subscription->owner->email }}</td>
							<td>Phone: {{ $subscription->owner->phone }}</td>
						</tr>
						<tr>
							<td>Address: {{ $subscription->owner->r_address }}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table width="100%">
		    <thead style="background-color: lightgray;">
		      <tr>
		        <th>Title</th>
		        <th>Duration</th>
		        <th>Start</th>
		        <th>End</th>
		        <th>Fee</th>
		        <th>Paid</th>
		        <th>Owe</th>
		        <th>PC No</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td align="left">{{$subscription->subscriber->title}}</td>
		        <td align="left">{{$subscription->duration}} week(s) </td>
		        <td align="right">{{$subscription->startsAt()}}</td>
		        <td align="right">{{$subscription->endsAt()}}</td>
		        <td align="right">{{$subscription->invoice->amount / 100}}</td>
		        <td align="right">{{str_replace('-', '', $subscription->invoice->totalPayments() / 100)}}</td>
		        <td align="right">{{$subscription->invoice->amountOwed() / 100}}</td>
		        <td align="right">{{$subscription->system_no}}</td>
		      </tr>
		    </tbody>
		</table>
		<hr>
	@endforeach
</body>
</html>