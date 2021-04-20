<?php

namespace App;

use App\Employee;
use App\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoleHistory extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
