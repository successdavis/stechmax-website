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
            'f_name'    => 'required|min:3',
            'l_name'    => 'required|min:2',
            'gender'    => 'required',
            'phone'     => 'required|min:11',
            'dob'       => 'required',
            'r_address' => 'required|min:10',
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

    public function edit() {
        return view('dashboard.users.settings');
    }

    public function update(User $user)
    {
// this method is used to update a user by an admin
        $this->validate(request(), [
            'surname'    => 'required|min:3',
            'last_name'    => 'required|min:2',
            'gender'    => 'required',
            'phone'     => 'required|min:11',
            'address' => 'required|min:10',
            'email'     => 'email|unique:users,email',
        ]);

        try {
            $user->update([
                'f_name' => request('surname'),
                'l_name' => request('last_name'),
                'm_name' => request('middle_name'),
                'r_address' => request('address'),
                'dob' => request('dob'),
                'gender' => request('gender'),
                'phone' => request('phone'),
                'alternative_phone' => request('alternative_phone'),
            ]);
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
