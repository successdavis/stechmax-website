<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(User $user)
    {
        return view('dashboard.payroll.index');
    }
}
