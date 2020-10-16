<?php

namespace App\Http\Controllers;

use App\Client;
use App\clienttestimonial;
use Illuminate\Http\Request;

class ClienttestimonialController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'recommendation_rate'=> 'required',
            'satisfaction_rate' => 'required',
            'testimonial'       => 'required|spamfree',
            'suggestion'        => 'nullable|spamfree',
        ]);
        try {
            $client = Client::where('testimonial_token', request('token'))
                ->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->action('HomepageController@index')
                ->with('flash', 'Invalid URL.');
        }

        $result = $client->addTestimony($request->testimonial, $request->rate);

        if(request()->wantsJson()) {
            return $result;
        }

        $client->deleteToken();
        $thanks = 'Thanks';

        session(['thanks' => $client->fullname . ', Thank you for your support']);
//        return back()->with('flash', 'thank you');
        return view('singlepages.clienttestimonial');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clienttestimonial  $clienttestimonial
//     * @return \Illuminate\Http\Response
     */
    public function show(clienttestimonial $clienttestimonial)
    {
        try {
            $client = Client::where('testimonial_token', request('token'))
                ->firstOrFail();
        } catch (\Exception $e) {
            return redirect()->action('HomepageController@index')
                ->with('flash', 'Invalid URL.');
        }

        $token = request('token');

        return view('singlepages.clienttestimonial', compact('token'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clienttestimonial  $clienttestimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(clienttestimonial $clienttestimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clienttestimonial  $clienttestimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clienttestimonial $clienttestimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clienttestimonial  $clienttestimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(clienttestimonial $clienttestimonial)
    {
        //
    }
}
