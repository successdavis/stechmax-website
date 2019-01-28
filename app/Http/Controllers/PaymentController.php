<?php

namespace App\Http\Controllers;

use Paystack;
use App\Course;
use App\Invoice;
use App\Subject;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Payments\CoursePayment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Subject $subject, Course $course)
    {
        $class = true;
        if (request()->class == 'false') {
            $class = false;
            return view('payments.medium', compact('course','class'));
        }

        return view('payments.medium', compact('course', 'class'));
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Course $course, Request $request, $invoiceId = null)
    {
        if (isset($invoiceId) && !Invoice::validateInvoice(invoiceId)) {
            return back()->withErrors('Invalid Invoice, No invoice found');
        }
        $invoice_Id = empty($invoiceId) ? Invoice::createInvoice($course)->id : $invoiceId;

        $payment = new CoursePayment($request);
        $data = $payment->generatePayData($course, $invoice_Id);

        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $class = !empty($paymentDetails['data']['metadata']['class']) ? true : false;

        $course = Course::findOrFail($paymentDetails['data']['metadata']['course_id']);        
        $Invoice = Invoice::findOrFail($paymentDetails['data']['metadata']['invoice_id']);        

        request()->user()->updatePaystackId($paymentDetails['data']['customer']['customer_code']);
        request()->user()->subscribeToCourse($course, $class);
        $Invoice->makeValid();       
        $Invoice->recordPayment($paymentDetails['data']);
        return view('payments.success', compact('course'))
            ->with('flash', 'Payment Successful');
    }
}
0
