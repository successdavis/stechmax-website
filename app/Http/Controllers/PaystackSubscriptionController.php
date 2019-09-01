<?php

namespace App\Http\Controllers;

use Paystack;
use App\Course;
use App\Subject;
use Illuminate\Http\Request;

class PaystackSubscriptionController extends Controller
{
    public function makeFullPayment(Subject $subject, Course $course, Request $request)
    {
        $data = [
            // "amount" => $course->amount,
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "plan" => $course->plan_code,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                // 'invoice_id' => $invoice,
                'purpose' => 'Course Subscription',
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
        $course->createSubscription('', $invoice->id);

        return redirect('/paid/' . $course->id)
            ->with('flash', 'Payment Successful');
    }
}
