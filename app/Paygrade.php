<?php

namespace App;

use App\Employee;
use App\PaygradeHistory;
use App\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paygrade extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function pagradeHistory()
    {
        return $this->hasMany(PaygradeHistory::class);
    }
}
