<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PAYMENT RECEIPT</title>

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

    th {
        text-align: left;
    }

    @page { margin: 0px; }
    body { margin: 30px 20px; }
</style>

</head>
<body>
    <img 
        style="
            width: 60%; 
            display: block;
            margin: 0px; 
            margin-left: 50px; 
        " 
        src="{{url('/images/logo.png')}}"
    >
    <p style="margin: 0px; font-size: 12px; text-align:center">1c Hospital Lane Obudu, CRS.</p>

    <h3 style="text-align: center; margin: 10px 0px;">FEE PAYMENT</h3>
    <p style="margin:0;">{{$billable->title}}</p>
    <div style="margin: 0;">
        <table>
            <tr>
                <th style="font-size: 10.5px">Amount</th>
                <td style="text-align: right; font-size: 1.1em; font-weight: bolder">NGN {{number_format(str_replace('-', ' ', $payment->amount / 100),2)}}</td>
            </tr>
            <tr>
                <th style="font-size: 10.5px">Invoice Fee</th>
                <td style="text-align: right">NGN {{number_format(str_replace('-', ' ', $payment->invoice->amount / 100))}}</td>
            </tr>
            <tr>
                <th style="font-size: 10.5px">Total Pay</th>
                <td style="text-align: right">NGN {{number_format(str_replace('-', ' ', $payment->invoice->totalPayments() / 100))}}</td>
            </tr>
            <tr>
                <th style="font-size: 10.5px">Student</th>
                <td style="text-align: right">{{strToUpper($student->f_name)}} {{strToUpper($student->l_name)}}</td>
            </tr>
            <tr>
                <th style="font-size: 10.5px">Pmt Date</th>
                <td>{{$payment->created_at}}</td>
            </tr>
            <tr>
                <th style="font-size: 10.5px">Trans. Ref</th>
                <td>{{$payment->transaction_ref}}</td>
            </tr>
            <h2 style="text-align: center"><em>Thank You</em></h2>

            <p style="text-align: center">www.stechmex.com</p>
        </table>
    </div>

</body>
</html>
