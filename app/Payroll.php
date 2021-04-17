<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }

    public function bank()
    {
        return $this->belongsTo(BankDetail::class);
    }
}
