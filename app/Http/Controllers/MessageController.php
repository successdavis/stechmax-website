<?php

namespace App\Http\Controllers;

use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.message.index');
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
     * @return Message
     */
    public function store(Request $request)
    {
        request()->validate([
            'fullname'   => 'required|string',
            'message'   => 'required|string',
            'phone'     => 'nullable|min:11|max:11',
            'email'         => 'email:rfc',
        ]);

        return Message::addMessage([
            'fullname'      => $request->fullname,
            'message'       => $request->message,
            'phone'         => $request->phone,
            'email'         => $request->email,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
//     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $message->read_at = Carbon::now();
        $message->save();

        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
