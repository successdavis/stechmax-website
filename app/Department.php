<?php

namespace App;

use App\DepartmentHistory;
use App\Employee;
use App\JobTitle;
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
        return $this->hasMany(JobTitle::class);
    }
}
