<?php

namespace App\Http\Controllers;

use Paystack;
use App\Course;
use App\Invoice;
use App\Subject;
use Carbon\Carbon;
use App\Http\Requests;
use App\submittedpayments;
use Illuminate\Http\Request;
use App\Payments\CoursePayment;
//use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Course $course, Request $request, $invoiceId = null)
    {
//        if (isset($invoiceId) && !Invoice::validateInvoice(invoiceId)) {
//            return back()->withErrors('Invalid Invoice, No invoice found');
//        }
//        $invoice_Id = empty($invoiceId) ? Invoice::createInvoice($course)->id : $invoiceId;
//
//        $payment = new CoursePayment($request);
//        $data = $payment->generatePayData($course, $invoice_Id);
//
//
//        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    public function create()
    {
        return view('payments.submitDetails');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payee_name' => 'required',
            'amount' => 'required',
            'transaction_date' => 'required',
            'course' => 'required',
        ]);

        $paidDetails = submittedpayments::create(request()->all());

        return back()->with('flash', 'Your payment details was submitted Successful');
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $course = Course::findOrFail($paymentDetails['data']['metadata']['course_id']);        
        $Invoice = Invoice::findOrFail($paymentDetails['data']['metadata']['invoice_id']);

        $Invoice->recordPayment($paymentDetails['data']);
        $course->createSubscription('', $Invoice->id);

        request()->user()->updatePaystackId($paymentDetails['data']['customer']['customer_code']);

        return redirect('/paid/' . $course->id)
            ->with('flash', 'Payment Successful');
    }

    public function paymentSuccessful(Course $course)
    {
        return view('payments.success', compact('course'));
    }
}
