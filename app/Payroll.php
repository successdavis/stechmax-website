<?php

namespace App;

use App\Employee;
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
}
