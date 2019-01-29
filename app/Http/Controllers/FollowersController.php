<?php

namespace App\Http\Controllers;

use App\Followers;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:followers'
        ]); 

        $follower = Followers::create([
            'email' => request('email')
        ]);
        return back()
            ->with('flash', 'Thank you for following up on our news letter');
    }

}
