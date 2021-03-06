<?php

namespace App;

use App\DepartmentHistory;
use App\Employee;
use App\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function employee()
    {
    	return $this->hasMany(Employee::class);
    }

    public function departmentHistory($value='')
    {
    	return $this->hasMany(DepartmentHistory::class);
    }

    public function roles()
    {
        $this->hasMany(Role::class);
    }
}
