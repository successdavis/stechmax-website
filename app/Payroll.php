<?php

namespace App;

use App\Employee;
use Carbon\Carbon;
use App\PayrollAdjustment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function bank()
    {
        return $this->belongsTo(BankDetail::class);
    }

    public function payrollAdjustment()
    {
        return $this->hasMany(PayrollAdjustment::class);
    }

    public function balance()
    {
        return $this->where('status', 1)->sum('net_salary');
    }

    static public function generatePayroll()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {

            if ($employee->payroll()->whereMonth('created_at', Carbon::now()->month)->exists()) {
                continue;
            }

            $grossRevenue   = $employee->generateGrossRevenue();
            $netRevenue     = $employee->generateNetRevenue();

            $payroll = new self;
            $payroll->gross_salary      = $grossRevenue;
            $payroll->net_salary        = $grossRevenue - $netRevenue;
            $payroll->bank_details_id   = $employee->hasAddedPaymentDetails() ? $employee->getBankDetails()->id : null;
            $payroll->employee_id       = $employee->id;

            $payroll->save();
        }

        return true;
    }
}
