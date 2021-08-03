<?php

namespace App;

use App\Employee;
use App\JobTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoleHistory extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
