<?php

namespace App\Http\Controllers\Payment;

use Paystack;
use App\Course;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    public function index(Subject $subject, Course $course)
    {
        if ($course->hasActiveSubscription()) {
            return back();
        }

        $class = filter_var(request()->class, FILTER_VALIDATE_BOOLEAN);

        $debitCards = auth()->user()->debitCards()->get();

        return view('Payments.paymentmedium', compact('course', 'class','debitCards'));
    }


    public function store(Subject $subject, Course $course)
    {
        $amount = $course->amount;

        if (request()->pay_module === 'part') {
            $amount = $course->getFirstInstallment();
        }

        $invoice = $course->createInvoice();

        $data = [
            "amount" => $amount,
            "reference" => request()->reference,
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => $course->path() . '/callback',
            "metadata" => [
                'invoice_id' => $invoice->id,
                'course_id' => $course->id,
                'purpose'   => 'Course Subscription',
                'method'    => 'Paystack',
                'class'     => true
            ]
        ];

        return Paystack::getAuthorizationUrl($data)->redirectNow();

//        $course->createSubscription(auth()->id());
    }

    public function update(){
        dd(request()->all());
    }
}
