<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Mail;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        try {
            User::where('confirmation_token', request('token'))
                ->firstOrFail()
                ->confirm();
        } catch (\Exception $e) {
            return redirect(route('threads'))
                ->with('flash', 'unknown token.');
        }

        return redirect('/courses')
            ->with('flash', 'Your account is now confirmed');
    }

    public function create()
    {
        if (auth()->user()->confirmed) {
            dd(request()->all());
            // return redirect('/courses');
        }
        return view('auth.confirmEmailMessage');
    }

    public function resend()
    {
        $user = auth()->user();
        Mail::to($user)->send(new PleaseConfirmYourEmail($user));
        return back();
    }
}
