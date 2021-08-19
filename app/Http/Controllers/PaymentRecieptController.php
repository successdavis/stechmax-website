<?php

namespace App\Http\Controllers;

use App\payments;
use Illuminate\Http\Request;
use PDF;


class PaymentRecieptController extends Controller
{
    public function index(Payments $payment) {
        
        $student = $payment->invoice->owner;
        $billable = $payment->invoice->billable;

        $pdf = PDF::loadView('pdfs.payment-receipt', compact('payment','student','billable'))->setPaper([0, 0, 164.409, 701.89], 'portrait');

        return $pdf->stream();
    }
}
