<?php

namespace App\Payments;

class CoursePayment extends Payment
{

    public function fullPayment($course, $invoice = null)
    {
        $data = [
            "amount" => $course->fee,
            "reference" => request()->reference,
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'invoice_id' => $invoice,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => !empty(request()->class) ? request()->class : ''
            ],
        ];

        return $this->data = $data;
    }
    
    public function partPayment($course, $invoice = null)
    {
        $data = [
            "amount" => $course->getFirstInstallment(),
            "reference" => request()->reference,
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'course_id' => $course->id,
                'invoice_id' => $invoice,
                'purpose' => 'Course Subscription',
                'method' => 'Paystack',
                'class' => !empty(request()->class) ?? request()->class
            ],
        ];

        return $this->data = $data;
    }

}
