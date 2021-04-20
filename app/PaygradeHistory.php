<?php

namespace App;

use App\Employee;
use App\Paygrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaygradeHistory extends Model
{
    use HasFactory;

    public function employee()
    {
     	return $this->belongsTo(Employee::class);
    }

    public function paygrade()
    {
        return $this->belongsTo(Paygrade::class);
    }
}
