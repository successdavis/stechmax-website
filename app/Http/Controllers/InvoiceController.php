<?php

namespace App\Http\Controllers;

use App\Course;
use App\Fee;
use App\Http\Resources\InvoicesResource;
use App\Http\Resources\UserResource;
use App\Invoice;
use App\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index ()
    {
        return view('dashboard.payments.invoices', [
            'displayMenu' => true
        ]);
    }

    public function create()
    {
        return view('dashboard.payments.createInvoices', [
            'displayMenu' => true
        ]);
    }

    public function getallinvoices(Request $request)
    {
    	$query = Invoice::orderBy($request->column, $request->order);
        $invoice = $query->paginate($request->per_page);

        return InvoicesResource::collection($invoice);
    }

// This method returns all the invoices not for datatable
// so it does not need the ordery by and group sorting
    public function retrieveallinvoices(Request $request)
    {
        $invoices = Invoice::latest()->get();

        return InvoicesResource::collection($invoices);
    }

    public function store(Request $request)
    {
        if ($request->payingfor !== 'Course') {
            return $this->createFeeInvoice();
        }

        $this->validate(request(), [
            'course'    => 'required|exists:courses,id',
            'user'      => 'required|exists:users,id',
            'payingfor'  => 'required|string',
        ]);

        try {
            $course = Course::find(request()->course);
            $user = User::find(request()->user);
            $partpayment = request()->partpayment;
            $subscribeToCourse = request()->subscribeToCourse;
            $classroom = request()->classroom;

            if ($course->isSubscribedBy($user)) {
                abort(422, 'This user has an active subscription to this course.');
            }

            $invoice = $course->createInvoice($user->id, $partpayment,'',$course->getClassAmountDiscount(false));

            if ($subscribeToCourse == 1) {
                $course->createSubscription($user->id, $invoice->id, $classroom);
            }

            return $invoice;

        } catch (Exception $e) {
            return response('This user has an active subscription to this course.', 422);
        }
    }

    public function createFeeInvoice() {
        $this->validate(request(), [
            'payingfor'  => 'required|string',
            'user'      => 'required|exists:users,id',
        ]);

//        return error if payingfor doesnot exist in the db
        abort_if(!Fee::where('item',request('payingfor'))->exists(),500,'payable not found');


        $fee = Fee::where('item', request('payingfor'))->first();
        $partpayment = request()->partpayment;
        $user = User::find(request()->user);
        

        return $fee->createInvoice($user->id, $partpayment,'',$fee->amount);

    }

    public function findInvoice(Invoice $invoice)
    {
        return new InvoicesResource($invoice);
    }
}

