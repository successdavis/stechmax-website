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
            
            $payroll = new self;
            $payroll->gross_salary      = $employee->generateGrossRevenue();
            $payroll->net_salary        = $employee->generateNetRevenue();
            $payroll->employee_id       = $employee->id;
            $payroll->status            = 1;

            $payroll->save();
        }

        return true;
    }
}
