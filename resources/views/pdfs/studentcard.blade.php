<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Card</title>

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

</head>
<body>

	<h1 style="text-align: center">STUDENT PERMIT CARD</h1>
  	<table width="100%">
  		<col width="180">
  		<col width="80">
	    <tr>
	        <td valign="top">
	        	<img src="{{$user->passport_path}}" style="width: 120px; height: 120px; border-radius:" alt="" width="150"/>
	        	<h3>ID No: {{$user->user_id}} </h3>

			    <table style="line-height: 1.4em; font-size: 1.2em">
				    <tr>
				    	<td>First Name:</td>
				    	<td>{{ ucfirst($user->f_name) }}</td>
				    </tr>
				    <tr>
				    	<td>Middle Name:</td>
				    	<td>{{ ucfirst($user->m_name) }}</td>
				    </tr>
				    <tr>
				    	<td>Last Name:</td>
				    	<td>{{ ucfirst($user->l_name) }}</td>
				    </tr>
				    <tr>
				    	<td>Gender:</td>
				    	<td>{{ ucfirst($user->gender) }}</td>
				    </tr>
				    <tr>
				    	<td>Phone Number:</td>
				    	<td>{{ $user->phone }}</td>
				    </tr>
				    <tr>
				    	<td>Email:</td>
				    	<td>{{ $user->email }}</td>
				    </tr>
				    <tr>
				    	<td>Date Joined:</td>
				    	<td>{{$user->date_joined()}}</td>
				    </tr>
			    </table>
	        </td>
	        <td style="vertical-align: top;">
	            <h2>REGISTERED COURSE(S)</h2>
	            @foreach ($subscriptions as $subscription)
		            <div style="font-size: 1.3em; line-height: 1.5em;">
		            	<div><strong>Title: </strong> {{$subscription->subscriber->title}} </div>
		            	<div><strong>PC No: </strong> {{$subscription->system_no}}</div>
		            	<div><strong>Duration: </strong> {{$subscription->duration}} week(s) </div>
		            	<div><strong>Start: </strong> {{$subscription->startsAt()}} </div>
		            	<div><strong>End: </strong> {{$subscription->endsAt()}} </div>
		            	<div><strong>Course Fee: </strong> {{$subscription->invoice->amount / 100}} </div>
		            	<div><strong>Amount Paid: </strong> {{str_replace('-', '', $subscription->invoice->totalPayments() / 100)}} </div>
		            	<div><strong>Amount Owe: </strong> {{$subscription->invoice->amountOwed() / 100}} </div>
		            	<hr>
		            </div>
	            @endforeach
	        </td>
	        <td></td>
	    </tr>
	</table>
	<div style="position: absolute; bottom: 0; text-align: center;"><strong>Note:</strong> This permit card must be made available if requested. Keep in save place</div>
</body>
</html>