<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PleaseConfirmYourEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    public function resendVerifyToken(Request $request)
    {
        if (auth()->user()->canSendNewToken()) {
            auth()->user()->smartSendToken();
            return 'Token resent successfully';
        }
        abort(422, 'Please wait atleast five minutes before trying to resend token');
    }

// at the moment I dont know why I named this method phoneReset and I cannot find where this method is being used
    public function phoneReset(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:11'
        ]);

        try {
            $user = User::wherePhone(request('phone'))->firstOrFail()
                ->smartSendToken();
        } catch (\Exception $e) {
            return response('You do not have an Account with us', 422);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|min:6|max:6',
            'phone' => 'required|min:11|max:11',
        ]);
        $validator->after(function ($validator) {
            if (! User::where('phone_token', request('token'))->where('phone', request('phone'))->exists()) {
                $validator->errors()->add('token', 'This token is invalid');
            }
        })->validate();

        try {
            $user = User::where('phone_token', request('token'))->where('phone', request('phone'))
                ->firstOrFail()
                ->confirmToken()
                ->updatePassword(request('password'));
                return 'Password Updated';
        } catch (\Exception $e) {
            return response('Sorry! We do not recognize this token', 422);
        }
    }
}
