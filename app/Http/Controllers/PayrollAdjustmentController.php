<?php

namespace App\Http\Controllers;

use App\Employee;
use App\PayrollAdjustment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $adjustments = [
        'Dearness_bonus'      => ['amount' => '1000', 'type'=> 'Credit'],
        'Bonus'               => ['amount' => '500', 'type'=> 'Credit'],
        'Holiday_allowance'   => ['amount' => '1500', 'type'=> 'Credit'],
    ];
    protected $type = 'deduction';

    protected $adjustmentBounceDate = 29; // Once this date passes, adjustment can no longer be added

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'description'   => 'required|string',
            'amount'        => 'required',
            'employees'     =>  'required|array',
            'type'          =>  'nullable|string',
            'isMore'        => 'required|boolean'
        ]);

        // Check if we are still within adjustment period
        $dt = intval(Carbon::now()->format('d'));
        if ($dt >= $this->adjustmentBounceDate) {
            return response('You have passed the adjustment period for this month, try again next month', 400);
        }

        // Check if there is an unpaid payroll for this month
        // Add the adjustment and link it to the payroll


        // If it is a costume adjustment that is not known, get the price and amount
        if ($request->isMore) {
            $amount = $request->amount ;
            $type   = $request->type ;
        }else {
            $amount =  $this->adjustments[$request->description]['amount'];
            $type   =  $this->adjustments[$request->description]['type'];
        }

        $adjustmentAlreadyExists = [];


        foreach ($request->employees as $employee) {
            if(
                PayrollAdjustment::whereMonth('created_at', Carbon::now()->month)
                ->whereDescription($request->description)
                ->where('employee_id', $employee['id'])->exists()
            ){
                $adjustmentAlreadyExists[] = $employee['name'];
                continue;
            }

            $dbemployee = Employee::find($employee['id']);

            $adjustment = new payrollAdjustment();
            $adjustment->employee_id    = $dbemployee->id;
            $adjustment->description    = $request->description;
            $adjustment->amount         = $amount;
            $adjustment->type           = $type;

            
            $adjustment->save();

            return $adjustment;

        }
            return $adjustmentAlreadyExists;
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
