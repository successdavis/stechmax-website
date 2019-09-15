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
        return view('auth.confirmEmailMessage');
    }

    public function resend()
    {
        $user = auth()->user();
        Mail::to($user)->send(new PleaseConfirmYourEmail($user));
        return back();
    }

    public function verifyToken(Request $request)
    {
        $request->validate([
            'token' => 'required|min:6'
        ]);

        try {
            User::where('phone_token', request('token'))
                ->firstOrFail()
                ->confirmToken();

            return 'Account Activated';
        } catch (\Exception $e) {
            return response('Sorry! We do not recognize this token', 422);
        }

        return response('Account Activated', 200);
    }
}
