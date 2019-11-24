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
        $data = [
            "amount" => $course->amount,  //We get the amount from the subscription plan on paystack
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            // "plan" => $course->plan_code,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => !empty(request()->class) ? request()->class : ''
            ],
        ];
        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    public function makePartPayment(Subject $subject, Course $course, Request $request)
    {
        $data = [
            "amount" => $course->getFirstInstallment(),
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            // "plan" => $course->plan_code, No plan code because paystack does not accept part payment on plan we make straight payment
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'purpose' => '60% payment of Course Subscription',
                'method' => 'Paystack',
                'class' => !empty(request()->class) ? request()->class : ''
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

        return redirect('/paid/' . $course->id)
            ->with('flash', 'Payment Successful');
    }
}
