<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollStatusController extends Controller
{
    // Update payroll status to paid and associate the current bank details to the payroll
    public function markAsPaid(Payroll $payroll) {

        if ($payroll->employee->hasAddedPaymentDetails() === false) {
            abort(424, 'Employee does not have an account number');
        }

        $payroll->status            = 2;
        $payroll->updated_at        = Carbon::now();
        $payroll->bank_details_id   = $payroll->employee->getBankDetails()->id;
        $payroll->save();

        return true;
    }
}