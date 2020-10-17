<?php

namespace App\Http\Controllers;

use App\Client;
use App\Filters\ClientFilters;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ClientFilters $filters)
    {
        if (request()->wantsJson()){
            $query = Client::filter($filters)->orderBy($request->column, $request->order);

            $clients = $query->paginate($request->per_page);
            return $clients;
        }

        return view('dashboard.clients.index');

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
            'title'         => 'required',
            'fullname'      => 'required',
            'gender'        => 'required',
            'phone'         => 'required|min:11|max:11|unique:clients',
            'alt_phone'     => 'nullable|min:11|max:11',
            'email'         => 'email:rfc|nullable|unique:clients',
        ]);

        $client = new Client();
        $client->title   = $request->title;
        $client->fullname   = $request->fullname;
        $client->gender     = $request->gender;
        $client->phone      = $request->phone;
        $client->alt_phone  = $request->alt_phone;
        $client->email      = $request->email;
        $client->note      =  $request->note;

        $client->save();

        return $client;
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
            'phone'         => 'required|min:11|max:11',
            'alt_phone'     => 'nullable|min:11|max:11',
        ]);

        $client->fullname   = $request->fullname;
        $client->gender     = $request->gender;
        $client->phone      = $request->phone;
        $client->alt_phone  = $request->alt_phone;

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
            'avatar' => ['required', 'image','max:3000']
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

    public function generatetoken(Client $client) {
        $client->generateTestimonialToken();
        return '/clienttestimonial/' . $client->testimonial_token;
    }
}
