<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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
            'r_address' => 'required',
            'email'     => 'email|unique:users,email'
        ]);

        return User::create([
            'f_name' => request('f_name'),
            'l_name' => request('l_name'),
            'm_name' => request('m_name'),
            'r_address' => request('r_address'),
            'dob' => request('dob'),
            'username' => request('f_name') . ' ' . request('l_name'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'alternative_phone' => request('alternative_phone'),
            'email'  =>request('email'),
            'password' => Hash::make(request('success_techmax')),
        ]);

    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function update(User $user)
    {
        try {
            $user->update(request()->all());
        } catch (Exception $e) {
            return $response (
                'Sorry user could not be updated at this time', 422
            );
        }
    }

    public function getUsersForDataTable(Request $request)
    {
        $query = User::orderBy($request->column, $request->order);
        $user = $query->paginate($request->per_page);

        return UserResource::collection($user);

    }
}
