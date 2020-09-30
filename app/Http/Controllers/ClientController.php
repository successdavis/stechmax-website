<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        request()->validate([
            'fullname'      => 'required',
            'gender'        => 'required',
            'phone'         => 'required',
        ]);

        $client = new Client();
        $client->fullname   = $request->fullname;
        $client->gender     = $request->gender;
        $client->phone      = $request->phone;
        $client->alt_phone  =  $request->alt_phone;

        $client->save();

        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        request()->validate([
            'fullname'      => 'required',
            'gender'        => 'required',
            'phone'         => 'required',
        ]);

        $client->fullname   = $request->fullname;
        $client->gender     = $request->gender;
        $client->phone      = $request->phone;
        $client->alt_phone  =  $request->alt_phone;

        $client->save();

        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response([], 200);
    }

    public function storePassport(Request $request, Client $client) {
        $this->validate(request(), [
            'avatar' => ['required', 'image']
        ]);

        if (auth()->user()->isAdmin())
        {
            $client->update([
                'image_path' => request()->file('avatar')->store('clientimages', 'public')
            ]);

            return response([], 204);
        }

        return response([], 204);
    }
}
