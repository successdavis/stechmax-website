<?php

namespace App;

use App\Payroll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollAdjustment extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    public static function recordAdjustment($description, $amount, $userId)
    {
    	$adjustment = new self;
        $adjustment->description 	= $description;
        $adjustment->amount 		= $amount;
        $adjustment->employee_id 	= $userId;
        $adjustment->save();

        return $adjustment;
    }
}
