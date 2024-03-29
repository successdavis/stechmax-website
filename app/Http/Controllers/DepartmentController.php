<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::with('roles')->get();

        return $departments;
    }
}
