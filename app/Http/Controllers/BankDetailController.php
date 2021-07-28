<?php

namespace App\Http\Controllers;

use App\BankDetail;
use App\Employee;
use App\User;
use Illuminate\Http\Request;

class BankDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {

        return view('dashboard.payroll.bank');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Employee $employee, Request $request)
    {

        $request->validate([
            'bank_name'         => 'required|string',
            'account_name'      => 'required|string',
            'account_number'    => 'required|unique:bank_details|min:10|max:10',
            'account_type'      =>  'required',
        ]);

        if ($employee->hasAddedPaymentDetails()) {
            $bankdetails            = $employee->getBankDetails();
            $bankdetails->active    = false;
            $bankdetails->save();
        }

        $bankdetails = new BankDetail();
        $bankdetails->bank_name         = $request->bank_name;
        $bankdetails->account_name      = $request->account_name;
        $bankdetails->account_number    = $request->account_number;
        $bankdetails->account_type      = $request->account_type;
        $bankdetails->employee_id       = $employee->id;

        $bankdetails->save();

        return $bankdetails;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bank_detail  $bank_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Request $request)
    {
        $bankdetails = $employee->getBankDetails();

        return $bankdetails;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bank_detail  $bank_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(bank_detail $bank_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bank_detail  $bank_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bank_detail $bank_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bank_detail  $bank_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(bank_detail $bank_detail)
    {
        //
    }
}
