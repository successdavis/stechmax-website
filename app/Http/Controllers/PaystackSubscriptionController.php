<?php

namespace App\Http\Controllers;

use App\Course;
use App\DebitCardDetails;
use App\Invoice;
use App\Subject;
use App\Fee;
use App\Traits\Paystack;
use Illuminate\Http\Request;

class PaystackSubscriptionController extends Controller
{
    use Paystack;

    public function makeFullPayment(Subject $subject, Course $course, Request $request)
    {
        $request->validate([
            'class'     => 'required'
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $reference_num = rand(10*45, 100*98);


        $data = [
            "amount" => $class ? $course->getClassAmountDiscount(false) : $course->getDiscountAmount(false),
            "key" => getenv('PAYSTACK_SECRET_KEY'),
            "email" => auth()->user()->email ? auth()->user()->email : 'support@stechmax.com',
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => getenv('DOMAIN_NAME') . '/payment/callback',
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => $class,
            ],
        ];


        $url = "https://api.paystack.co/transaction/initialize";

        $fields_string = http_build_query($data);

        $responds = $this->makePaystackRequest($url, $fields_string);

        return redirect($responds['data']['authorization_url']);
    }

    public function chargeWithDebitCard(Subject $subject, Course $course, Request $request)
    {
        $request->validate([
            'class'     => 'required|boolean',
            'signature' => 'required|exists:debit_card_details,signature',
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $reference_num = rand(10*45, 100*98);

        $card = DebitCardDetails::whereSignature($request->signature)->first();



        $data = [
            "amount" => $class ? $course->getClassAmountDiscount(false) : $course->getDiscountAmount(false),
            "authorization_code" => $card->authorization_code,
            "email" => auth()->user()->email ? auth()->user()->email : 'support@stechmax.com',
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => $class,
            ],
        ];

        $url = "https://api.paystack.co/transaction/charge_authorization";

        $fields_string = http_build_query($data);

        $responds = $this->makePaystackRequest($url, $fields_string);

        if (!isset($responds['data']['status']) || $responds['data']['status'] !== 'success') {
            abort(400, 'Invalid Transaction');
        }

        if ($class) {
            $this->createClassroomSubscription($course, $responds);
        }else {
            $this->createOnlineSubscription($course, $responds);
        }

        return redirect('/paid/' . $course->slug)
            ->with('flash', 'Payment Successful');

    }

    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = $this->verifyTransaction($request->reference);

        $card = $this->saveCardDetails($paymentDetails['data']['authorization']);

        if (!$paymentDetails) {
            abort(400, 'Invalid Transaction');
        }

        $paymentDetails = $paymentDetails;
        $course = Course::findOrFail($paymentDetails['data']['metadata']['course_id']);   
        request()->user()->updatePaystackId($paymentDetails['data']['customer']['customer_code']);

        $class = boolval($paymentDetails['data']['metadata']['class']);


        if ($class) {
            $this->createClassroomSubscription($course, $paymentDetails);
        }else {
            $this->createOnlineSubscription($course, $paymentDetails);
        }

        return redirect('/paid/' . $course->slug)
        ->with('flash', 'Payment Successful');
    }

    public function saveCardDetails($cardDetails)
    {

        if (DebitCardDetails::findCard($cardDetails['signature'])->get()->isEmpty()) {
            $card = DebitCardDetails::saveCardDetails($cardDetails);

            return $card;
        }
        
        $card = DebitCardDetails::findCard($cardDetails['signature']);
        return $card;
    }

    public function createClassroomSubscription($course, $paymentDetails)
    {
        $invoice = $course->createInvoice('','','',$course->getClassAmountDiscount(false));

        $invoice->recordPayment($paymentDetails['data']);

        return $course->createSubscription('', $invoice->id, $class = true);
    }

    public function createOnlineSubscription($course, $paymentDetails)
    {
        $invoice = $course->createInvoice('','');
        $invoice->recordPayment($paymentDetails['data']);
        
        return $course->createSubscription('', $invoice->id, $class = false);
    }
}
