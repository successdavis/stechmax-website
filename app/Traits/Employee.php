<?php

namespace App\Traits;

use App\BankDetail;
use App\Department;
use App\DepartmentHistory;
use App\JobTitleHistory;
use App\Jobtitle;
use App\Paygrade;
use App\PaygradeHistory;
use App\Payroll;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Employee
{

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function departmentHistory()
    {
        return $this->hasMany(DepartmentHistory::class);
    }


    public function jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }

    public function jobtitlehistory()
    {
        return $this->hasMany(JobTitleHistory::class, 'emp_id');
    }

    public function paygrade()
    {
        return $this->belongsTo(Paygrade::class);
    }

    public function paygradeHistory()
    {
        return $this->hasMany(PaygradeHistory::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'emp_id');
    }

    public function bankDetails()
    {
        return $this->hasMany(BankDetail::class, 'emp_id');
    }

    public function getBankDetails()
    {
        return $this->bankdetails()->where('active', 1)->first();
    }

    public function getShortMaskAccout()
    {
        return $this->hasAddedPaymentDetails() ? 
            '******' . substr(($this->getBankDetails()->account_number), -4) :
            'Please provide an account number';
    }

    public function hasAddedPaymentDetails()
    {
        return !$this->bankdetails->isempty();
    }
}