<?php

namespace App;

use App\Employee;
use App\Paygrade;
use App\RoleHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Role extends Role
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function history()
    {
        return $this->hasMany(RoleHistory::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function paygrade()
    {
        return $this->hasMany(Paygrade::class);
    }
}

// This class only extends the actual Role class from Spatie, allowing other classes to interact with roles. 
// $user->roles is invalid instead you must access user roles using spatie methods user->getRoleNames()
