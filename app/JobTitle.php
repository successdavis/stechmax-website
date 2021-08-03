<?php

namespace App;

use App\Employee;
use App\Paygrade;
use App\RoleHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class JobTitle extends Role
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function histories()
    {
        return $this->hasMany(RoleHistory::class, 'role_id');
    }

    public function paygrades()
    {
        return $this->hasMany(Paygrade::class, 'role_id');
    }
}

// This class only extends the actual Role class from Spatie, allowing other classes to interact with roles. 
// $user->roles is invalid instead you must access user roles using spatie methods user->getRoleNames()


// We have departments, a department has many job titles (paygrade), and a job title has many paygrade level e.g. 
// Printing Department -> i. Shirt Print, Engraving, Binding, -> i. Senior Print Press ii. Junior Print Press