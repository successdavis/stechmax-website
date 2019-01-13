<?php

namespace App\Http\Controllers;

use Paystack;
use App\Course;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('courses.product');
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Course $course)
    {
        $data = [
                "amount" => $course->fee,
                "reference" => request()->reference,
                "email" => auth()->user()->email,
                "plan" => request()->plan_code,
                "name" => auth()->user()->name,
                "callback_url" => request()->callback_url
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

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
