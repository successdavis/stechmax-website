<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilters;
use App\Http\Resources\EmployeeResource;

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
        $transactions = $employee->transactions();

    	$netEarning = $employee->thisMonthNetEarning();

    	$grossEarning = $employee->thisMonthGrossEarning();
    	$lastMonthPayroll = $employee->lastMonthEarning();


    	// return $grossEarning;
    	// return $data;

        return view('dashboard.payroll.index', compact(['balance','lastMonthPayroll','netEarning','grossEarning','transactions']));
    }

    public function list(Request $request, EmployeeFilters $filters)
    {
        if (request()->wantsJson()){
            $query = Employee::filter($filters)->orderBy($request->column, $request->order);

            $employees = $query->paginate($request->per_page);
            return EmployeeResource::collection($employees);
        }

        return view('dashboard.payroll.employees');

        // $employees = Employee::latest()->get();

        // return view('dashboard.payroll.employees', compact('employees'));
    }

    public function show(Employee $employee)
    {
        $transactions = $employee->transactions();
        $bankdetails = $employee->getBankDetails();

        return view('dashboard.payroll.show', compact('employee', 'transactions','bankdetails'));
    }
}
