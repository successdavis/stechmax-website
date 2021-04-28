<?php

namespace App\Http\Controllers;

use App\Employee;
use App\PayrollAdjustment;
use Illuminate\Http\Request;

class PayrollAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $adjustments = [
        'Dearness_bonus'      => '1000',
        'Bonus'               => '500',
        'Holiday_allowance'   => '1500',
    ];

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->employees as $employee) {
            $dbemployee = Employee::findOrFail($employee['id']);

            $adjustment = new payrollAdjustment();
            $adjustment->employee_id        = $dbemployee->id;
            $adjustment->description    = $request->description;
            $adjustment->amount         = $this->adjustments[$request->description];

            $adjustment->save();

            return $adjustment;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PayrollAdjustment  $payrollAdjustment
     * @return \Illuminate\Http\Response
     */
    public function show(PayrollAdjustment $payrollAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayrollAdjustment  $payrollAdjustment
     * @return \Illuminate\Http\Response
     */
    public function edit(PayrollAdjustment $payrollAdjustment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayrollAdjustment  $payrollAdjustment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayrollAdjustment $payrollAdjustment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayrollAdjustment  $payrollAdjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayrollAdjustment $payrollAdjustment)
    {
        //
    }
}
