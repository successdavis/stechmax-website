<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }

    public function ()
    {
        return $this->hasMany(Payroll::class);
    }
}
