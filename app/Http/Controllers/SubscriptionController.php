<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index(User $user)
    {
        $Subscriptions = $user->getSubscribedCourses;

        return view('profiles.courses', [
            'profileUser' => $user,
        ]);
    }
}
