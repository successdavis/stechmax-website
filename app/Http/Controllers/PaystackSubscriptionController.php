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

        $data = [
            "amount" => $class ? $course->getAmountWithClassroom() : $course->amount,
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => $class,
            ],
        ];

        dd($data);

        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    public function makePartPayment(Subject $subject, Course $course, Request $request)
    {
        $request->validate([
            'class'     => 'required|boolean'
        ]);

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $data = [
            "amount" => $course->getFirstInstallment('', true),
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => '60% payment of Course Subscription',
                'method' => 'Paystack',
                'class' => $class
            ],
        ];
        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    public function requestAuthorization($payload)
    {
        $data = [
            "amount" => $payload['amount'],
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => '60% payment of Course Subscription',
                'method' => 'Paystack',
                'class' => $class
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
