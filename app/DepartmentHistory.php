<?php

namespace App;

use App\Paygrade;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentHistory extends Model
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
