<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{

    use RecordsActivity;
    protected $guarded = [];
    protected $activityPriority = 1;
    protected $casts = [
        'refundable' => 'boolean',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    static public function monthlyTotalPay()
    {
    	$amount = self::whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->sum('amount') / 100;
        return $newAmount = number_format(str_replace('-', '', $amount), 2);
    }

    static public function yearTotalPay()
    {
    	$amount = self::whereYear('created_at', Carbon::now()->year)
                    ->sum('amount') / 100;
        return $newAmount = number_format(str_replace('-', '', $amount),2);
    }

    static public function feed()
    {
        return self::latest()->with('invoice')
            ->take(100)
            ->get()
            ->groupBy(function ($payment) {
                return $payment->created_at->format('Y-m-d');
            });
    }

}