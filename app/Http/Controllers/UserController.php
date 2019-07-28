<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('dashboard.users.settings', [
            'displayMenu' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $this->validate(request(), [
            'f_name'    => 'required|min:3',
            'l_name'    => 'required|min:2',
            'gender'    => 'required',
            'phone'     => 'required|min:11',
            'r_address' => 'required|min:10',
        ]);

        try {
            $user->update([
                'f_name' => request('f_name'),
                'l_name' => request('l_name'),
                'm_name' => request('m_name'),
                'r_address' => request('r_address'),
                'dob' => request('dob'),
                'gender' => request('gender'),
                'phone' => request('phone'),
                'alternative_phone' => request('alternative_phone'),
            ]);
        } catch (Exception $e) {
            return response (
                'Sorry user could not be updated at this time', 422
            );
        }
    }

    public function updatePassword(User $user)
    {
        $this->validate(request(), [
            'old_password'    => 'required',
            'new_password'=>'required|different:old_password|min:8',
            'confirm_password'=>'required|same:new_password'
        ]);

                
        if (!$user->validateAndUpdatePassword()) {
            return response('Your current password is incorrect', 401);
        }; 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
