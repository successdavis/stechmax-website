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

        $data = [
            "amount" => $class ? $course->getAmountWithClassroom(false) : $course->amount,
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

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
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

        $course->createSubscription('', $invoice->id, $class = $paymentDetails['data']['metadata']['class']);

        return redirect('/paid/' . $course->slug)
            ->with('flash', 'Payment Successful');
    }
}
