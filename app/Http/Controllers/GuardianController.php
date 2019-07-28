<?php

namespace App\Http\Controllers;

use App\User;
use App\Guardian;
use Illuminate\Http\Request;

class GuardianController extends Controller
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
    public function store(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required|min:6',
            'occupation' => 'required',
            'work_address' => 'required',
            'phone' => 'required',
            'r_address' => 'required',
            'relationship' => 'required'
        ]);

        return $user->guardians()->create([
            'title' => request('title'),
            'name' => request('name'),
            'occupation' => request('occupation'),
            'work_address' => request('work_address'),
            'phone' => request('phone'),
            'r_address' => request('r_address'),
            'relationship' => request('relationship'),
            'email' => request('email'),
            'company_name' => request('company_name'),
            'alternative_phone' => request('alternative_phone')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function show(Guardian $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function edit(Guardian $guardian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guardian $guardian)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required|min:6',
            'occupation' => 'required',
            'work_address' => 'required',
            'phone' => 'required',
            'r_address' => 'required',
            'relationship' => 'required'
        ]);

        $guardian->update([
            'title' => request('title'),
            'name' => request('name'),
            'occupation' => request('occupation'),
            'work_address' => request('work_address'),
            'phone' => request('phone'),
            'r_address' => request('r_address'),
            'relationship' => request('relationship'),
            'email' => request('email'),
            'company_name' => request('company_name'),
            'alternative_phone' => request('alternative_phone')
        ]);

        if (request()->wantsJson()) {
            return $guardian;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
