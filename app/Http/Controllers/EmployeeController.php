<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$employee = Employee::where('user_id',auth()->user()->id)->first();

		$balance = $employee->earningBalance();


    	$netEarning = $employee->thisMonthNetEarning();

    	$grossEarning = $employee->thisMonthGrossEarning();
    	$lastMonthPayroll = $employee->lastMonthEarning();


    	// return $grossEarning;
    	// return $data;

        return view('dashboard.payroll.index', compact(['balance','lastMonthPayroll','netEarning','grossEarning']));
    }
}
