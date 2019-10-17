<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Paystack;
use App\Invoice;
use App\Http\Resources\InvoicesResource;
use App\Http\Resources\UserPaymentsResource;

class BillingController extends Controller
{
    public function index()
    {
        $displayMenu = true;
    	return view('dashboard.billing.index', compact('displayMenu'));
    }

  	public function getallinvoices(User $user)
    {
        $invoices = $user->invoices;

        return InvoicesResource::collection($invoices);
    }

    public function totalamountowed(User $user)
    {
        return $user->getTotalAmountOwed();
    }

    public function clearInvoiceDebt(Invoice $invoice)
    {
        $data = [
            "amount" => $invoice->amountOwed(),
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'invoice_id' => $invoice->id,
                'course_id' => $invoice->billable->id,
                'purpose' => 'Invoice Payment',
                'method' => 'Paystack',
                'class' => !empty(request()->class) ? request()->class : ''
            ],
        ];
        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }

    public function specifyAmount(Invoice $invoice, Request $request)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        if (request()->amount > $invoice->amountOwed()) {
            abort(422, 'Amount specified too high');
        }

        if (request()->amount < 500) {
            abort(422, 'Amount specified too low');
        }
        $data = [
            "amount" => request()->amount . '00',
            "reference" => Paystack::genTranxRef(),
            "key" => config('paystack.secretKey'),
            "email" => auth()->user()->email,
            "first_name" => auth()->user()->f_name,
            "last_name" => auth()->user()->l_name,
            "callback_url" => request()->callback_url,
            "metadata" => [
                'invoice_id' => $invoice->id,
                'course_id' => $invoice->billable->id,
                'purpose' => 'Invoice Payment',
                'method' => 'Paystack',
                'class' => !empty(request()->class) ? request()->class : ''
            ],
        ];
        return Paystack::getAuthorizationUrl($data)->redirectNow();
    }
}
