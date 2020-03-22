<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{

    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    static public function monthlyTotalPay()
    {
    	$amount = self::whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->sum('amount');
        return $newAmount = str_replace('-', '', $amount);
    }

    static public function yearTotalPay()
    {
    	$amount = self::whereYear('created_at', Carbon::now()->year)
                    ->sum('amount');
        return $newAmount = str_replace('-', '', $amount);
    }
}
