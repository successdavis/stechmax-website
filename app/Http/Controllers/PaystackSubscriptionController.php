<?php

namespace App\Http\Controllers;

use App\Course;
use App\Invoice;
use App\Subject;
use App\siteconfig;
use Illuminate\Http\Request;
use Paystack;

class PaystackSubscriptionController extends Controller
{
    public function makeFullPayment(Subject $subject, Course $course, Request $request)
    {
        $request->validate([
            'class'     => 'required|boolean'
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $reference_num = rand(10*45, 100*98);

        $data = [
            "amount" => $class ? $course->getAmountWithClassroom(false) : $course->amount,
            "key" => getenv('PAYSTACK_SECRET_KEY'),
            "email" => auth()->user()->email ? auth()->user()->email : 'support@stechmax.com',
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => 'http://stechmax-website.test/payment/callback',
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => $class,
            ],
        ];

        $url = "https://api.paystack.co/transaction/initialize";

        $fields_string = http_build_query($data);

        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . getenv('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

          //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

        //execute post
        $result = curl_exec($ch);

        $responds = json_decode($result, true);

        return redirect($responds['data']['authorization_url']);
    }

    public function makePartPayment(Subject $subject, Course $course, Request $request)
    {

        $request->validate([
            'class'     => 'required|boolean'
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);


        $data = [
            "amount"    => $course->getFirstInstallment('', $class, false),
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email ? auth()->user()->email : 'support@stechmax.com',
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => $class,
            ],
        ];

        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = $this->verifyTransaction($request->reference);

        if (!$paymentDetails) {
            abort(400, 'Invalid Transaction');
        }

        $paymentDetails = $paymentDetails;
        $course = Course::findOrFail($paymentDetails['data']['metadata']['course_id']);   
        request()->user()->updatePaystackId($paymentDetails['data']['customer']['customer_code']);

        $class = $paymentDetails['data']['metadata']['class'] === 'true'? true: false;

        if (!isset($paymentDetails['data']['metadata']['invoice_id'])) {
            if ($class) {
                $classCharge = siteconfig::getclassroomfee();
                $invoice = $course->createInvoice('','', $classCharge);
            }else {
                $invoice = $course->createInvoice();
            }
        }else {
            $invoice = Invoice::findOrFail($paymentDetails['data']['metadata']['invoice_id']);
        }

        $invoice->recordPayment($paymentDetails['data']);

        if ($course->type === 2) {
            foreach ($course->childrenCourses as $course) {
                $course->createSubscription('', $invoice->id, $class = $class);
            }
        }

        $course->createSubscription('', $invoice->id, $class = $class);

        return redirect('/paid/' . $course->slug)
        ->with('flash', 'Payment Successful');
    }

    public function verifyTransaction($reference)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer " . getenv('PAYSTACK_SECRET_KEY'),
              "Cache-Control: no-cache",
          ),
        ));

        $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

        $data = json_decode($response, true);

        if ($err) {
            abort('Something unexpected happened', '500');
        } else {
            if (isset($data['data'])) {
                if ($data['data']['status'] === "success") {
                    return $data;
                }
                return false;
            }
            return false;
        }
    }
}
