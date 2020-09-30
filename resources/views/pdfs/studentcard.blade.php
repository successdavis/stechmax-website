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
        <p>Note: Amount Owe must be paid on or before midpoint </p>
        <h4 style="text-align: center">Code of Conduct</h4>
        <h4>Members shall:</h4>
        <ol type="a">
            <li>Act with integrity and shall not intentionally bring the Institute, staff or other members of the institute, into disrepute </li>
            <li>Exhibit honesty, integrity and transparency. </li>
            <li>Ensure that any professional activities do not unnecessarily put at risk the health or welfare of any person and they shall have due regard for the sustainability of any resource </li>
{{--            <li>Exercise all reasonable due diligence, in presenting quality work to the best of their ability and avoiding bias or unfair influence.</li>--}}
            <li>Handle any equipment/gadgets carefully to avoid damage.</li>
            <li>Replace any equipment damaged by him or her on or within the next 3 days</li>
        </ol>
        <h4>Members shall not</h4>
        <ol type="a">
            <li>Recklessly attempt to harm, directly or indirectly, the reputation or businesses of others</li>
            <li>Claim expertise or skill in any area of knowledge or professional practice in which they have insufficient competence or experience</li>
            <li>In any circumstance take any of the institutions or member's properties home without the consent of the institution.</li>
        </ol>
    <p>The institute reserves the right to withdraw your membership should you fail to comply with the codes of conduct guiding this institute</p>
    <p>To cancel your membership, you will need to notify us in writing stating a reason which will be recorded for internal use only. Refunds will not be given for cancelled membership </p>
	<div style="position: absolute; bottom: 0; text-align: center;"><strong>Note:</strong> This permit card must be made available if requested. Keep in save place</div>
</body>
</html>
