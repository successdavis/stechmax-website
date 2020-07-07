<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\Activity;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser'   => $user,
            'activities'    => Activity::feed($user),
            'achievements'  => Achievement::all(),
        ]);
    }

    public function getInvoices()
    {
        $invoice = Invoice::all()->latest();
        return view ('profiles.payments', compact('invoice'));
    }
}
