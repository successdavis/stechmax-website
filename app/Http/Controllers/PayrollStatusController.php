<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Payroll;
use Illuminate\Http\Request;

class PayrollStatusController extends Controller
{
    public function markAsPaid(Payroll $payroll) {
        $payroll->status = 2;
        $payroll->save();

        return true;
    }
}