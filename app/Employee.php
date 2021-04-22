<?php

namespace App;

use App\BankDetail;
use App\Department;
use App\DepartmentHistory;
use App\Models\Role;
use App\Paygrade;
use App\PaygradeHistory;
use App\Payroll;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'user_id';
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function departmentHistory()
    {
        return $this->hasMany(DepartmentHistory::class);
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function rolehistory()
    {
        return $this->hasMany(Rolehistory::class);
    }

    public function paygrade()
    {
        return $this->belongsTo(Paygrade::class);
    }

    public function paygradeHistory()
    {
        return $this->hasMany(PaygradeHistory::class);
    }

    public function payroll()
    {
        return $this->hasMany(Payroll::class);
    }
   
    public function bankDetails()
    {
        return $this->hasMany(BankDetail::class);
    }

    public function getBankDetails()
    {
        return $this->bankdetails()->where('active', 1)->first();
    }

    public function getMaskAccount()
    {
        return $this->hasAddedPaymentDetails() ? 
            '******' . substr(($this->getBankDetails()->account_number), -4) :
            'Please provide an account number';
    }

    public function hasAddedPaymentDetails()
    {
        return !$this->bankdetails->isempty();
    }

    public function earningBalance()
    {
        return number_format($this->payroll()->where('status', 1)->sum('net_salary'));;

    }

    public function thisMonthNetEarning()
    {
        return;
        if ($this->payroll()->whereMonth('created_at', Carbon::now()->month)->exists()) {
            $paryroll = $this->payroll()
                ->whereMonth('created_at', Carbon::now()->month)
                ->first();
            return $paryroll->net_salary;
        }

        return '0';
    }

    public function thisMonthGrossEarning()
    {
        return; 
        if ($this->payroll()->whereMonth('created_at', Carbon::now()->month)->exists()) {
            $payroll = $this->payroll()
                ->whereMonth('created_at', Carbon::now()->month)
                ->first();

            return $payroll->gross_salary;
        }

        return '0';
    }

    public function lastMonthEarning()
    {
        if (
            $this->payroll()
            ->whereMonth('created_at', Carbon::now()
                ->subMonth()
                ->format('m'))->exists()
        ) {
            return $this->payroll()
                ->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))
                ->first();      
        }

        return 0;
        
    }
   
}
