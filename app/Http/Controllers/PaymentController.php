<?php

namespace App\Http\Controllers;

use Paystack;
use App\Course;
use App\Invoice;
use App\Subject;
use App\payments;
use Carbon\Carbon;
use App\Http\Requests;
use App\submittedpayments;
use Illuminate\Http\Request;
use App\Payments\CoursePayment;
use App\Http\Resources\InvoicesResource;
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

    public function addpayment()
    {
        return view('dashboard.payments.addpayment');
    }

    public function savepayments()
    {
         $this->validate(request(), [
            'invoice' => 'required|exists:invoices,id',
            'amount' => 'required|min:0',
            'purpose' => 'required',
        ]);

        $invoice = Invoice::find(request()->invoice);
        $amount = '-' . request()->amount . '00';
        $purpose = request()->purpose;

        try {

            if (str_replace('-', '', $amount) > $invoice->amountOwed()) {
                abort(422, 'The amount you entered is greater than Invoice Amount Owed');
            }

            if ($invoice->completed) {
                abort(422, 'Sorry This invoice Can no longer recieve payment');
            }

            $payment = $invoice->payments()->create([
                'amount' => $amount,
                'method' => 'Admin',
                'purpose' => $purpose,
                'transaction_ref' => hexdec(uniqid()),
                'refundable'      => true,
            ]);

            return new InvoicesResource($invoice);
            
        } catch (Exception $e) {
            return response('This user has an active subscription to this course.', 422);
        }
    }

    public function refundPayment() {
         $this->validate(request(), [
            'invoice' => 'required|exists:invoices,id',
            'paymentId' => 'required|exists:payments,id',
        ]);


        try {
            $invoice = Invoice::find(request()->invoice);
            $oldPayment = payments::find(request()->paymentId);

            if ($invoice->completed) {
                abort(422, 'Sorry This invoice Can no longer recieve payment');
            }

            if ($oldPayment->refundable === false) {
                abort(422, 'Sorry! This invoice is not refundable');
            }

            $payment = $invoice->payments()->create([
                'amount' => ltrim($oldPayment->amount, '-'),
                'method' => 'Admin',
                'purpose' => 'refund-' . $oldPayment->transaction_ref,
                'transaction_ref' => hexdec(uniqid()),
                'refundable'      => false,
            ]);

            $oldPayment->refundable = false;
            $oldPayment->save();

            return new InvoicesResource($invoice);
            
        } catch (Exception $e) {
            return response('Sorry we were Unable to refund payment', 422);
        }
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

    public function paymentSuccessful(Course $course)
    {
        return view('payments.success', compact('course'));
    }
}
