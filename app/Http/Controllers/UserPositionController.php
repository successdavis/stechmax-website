<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;

class UserPositionController extends Controller
{
    public function store(Employee $employee, Request $request) {

         $request->validate([
            'department'    => 'required',
            'paygrade'      => 'required',
            'role'          => 'required',
         ]);

         $roles[] = $request->role['name'];

         $employee->department_id = $request->department['id'];

         $employee->user->syncRoles($roles);

         $employee->paygrade_id = $request->paygrade['id'];

         $employee->save();

         return $employee;
    }
}
