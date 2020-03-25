<?php

namespace App\Http\Controllers;

use Paystack;
use App\Course;
use App\Subject;
use App\Invoice;
use Illuminate\Http\Request;

class PaystackSubscriptionController extends Controller
{
    public function makeFullPayment(Subject $subject, Course $course, Request $request)
    {
        $request->validate([
            'class'     => 'required|boolean'
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $payload = [
            "amount" => $class ? $course->getAmountWithClassroom() : $course->amount,
            'purpose' => 'Full Payment of Course Subscription',
            'class' => $class,
        ];

        $this->requestAuthorization($course, $payload);
    }

    public function makePartPayment(Subject $subject, Course $course, Request $request)
    {
        $request->validate([
            'class'     => 'required|boolean'
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $payload = [
            "amount"    => $course->getFirstInstallment('', true),
            'purpose'   => '60% payment of Course Subscription',
            'class'     => $class
        ];
        $this->requestAuthorization($course, $payload);
    }

    public function requestAuthorization($course, $payload)
    {
        $data = [
            "amount" => 100000,
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => $payload['purpose'],
                'method' => 'Paystack',
                'class' => $payload['class']
            ],
        ];
        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }


    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $course = Course::findOrFail($paymentDetails['data']['metadata']['course_id']);   
        request()->user()->updatePaystackId($paymentDetails['data']['customer']['customer_code']);


        if (!isset($paymentDetails['data']['metadata']['invoice_id'])) {
            $invoice = $course->createInvoice();
        }else {
            $invoice = Invoice::findOrFail($paymentDetails['data']['metadata']['invoice_id']);
        }

        $invoice->recordPayment($paymentDetails['data']);

        // dd($paymentDetails);
        $course->createSubscription('', $invoice->id, $class = $paymentDetails['data']['metadata']['class']);

        return redirect('/paid/' . $course->slug)
            ->with('flash', 'Payment Successful');
    }
}
