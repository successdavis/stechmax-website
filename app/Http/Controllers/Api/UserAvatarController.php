<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{ 

    public function __construct()
    {
        $this->middleware(['admin'])->only('storePassport');
    }
 
    public function store(User $user)
    {
        $this->validate(request(), [
            'avatar' => ['required', 'image']
        ]);

        if (auth()->user()->isAdmin())
        {
            $user->update([
                'avatar_path' => request()->file('avatar')->store('avatars', 'public')
            ]);

            return response([], 204);
            exit;
        }

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return response([], 204);

        // return back(); 
    }

    public function storePassport(User $user)
    {

        $this->validate(request(), [
            'passport' => ['required', 'image']
        ]);

        $user->update([
            'passport_path' => request()->file('passport')->store('passports', 'public')
        ]);

        return response([], 204);

        // return back(); 
    }
}
