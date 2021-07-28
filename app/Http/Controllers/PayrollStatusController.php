<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollStatusController extends Controller
{
    public function markAsPaid(Payroll $payroll) {
        $payroll->status = 2;
        $payroll->updated_at = Carbon::now();
        $payroll->save();

        return true;
    }
}