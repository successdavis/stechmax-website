<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function employee()
    {
    	return $this->hasMany(User::class);
    }

    public function departmentHistory($value='')
    {
    	return $this->hasMany(DepartmentHistory::class);
    }

    public function jobtitle()
    {
        $this->hasMany(Jobtitle::class);
    }
}
