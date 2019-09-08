<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Course;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\InvoicesResource;

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

    public function store()
    {
        $this->validate(request(), [
            'course' => 'required|exists:courses,id',
            'user' => 'required|exists:users,id',
        ]);

        try {
            $course = Course::find(request()->course);
            $user = User::find(request()->user);
            $partpayment = request()->partpayment;
            $subscribeToCourse = request()->subscribeToCourse;

            if ($course->isSubscribedBy($user)) {
                abort(422, 'This user has an active subscription to this course.');
            }

            $invoice = $course->createInvoice($user->id, $partpayment);

            if ($subscribeToCourse == 1) {
                $course->createSubscription($user->id, $invoice->id);
            }

            return $invoice;
            
        } catch (Exception $e) {
            return response('This user has an active subscription to this course.', 422);
        }
    }
}
