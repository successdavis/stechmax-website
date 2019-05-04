<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index ()
    {
        return view('dashboard.users.index', [
            'displayMenu' => true
        ]);
    }

    public function store()
    {
        $this->validate(request(), [
            'f_name'    => 'required',
            'l_name'    => 'required',
            'gender'    => 'required',
            'phone'     => 'required',
            'email'     => 'email|unique:users,email'
        ]);

        return User::create([
            'f_name' => request('f_name'),
            'l_name' => request('l_name'),
            'username' => request('f_name') . ' ' . request('l_name'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'email'  =>request('email'),
            'password' => Hash::make(request('success_techmax')),
        ]);

    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function get_users()
    {
        return $users = User::all();
    }
}
