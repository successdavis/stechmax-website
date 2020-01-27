<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        $email_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL ) 
            ? 'email' 
            : 'phone';

        $request->merge([
            $email_type => $request->input('email')
        ]);

        if (Auth::attempt($request->only($email_type, 'password'))) {
            if (request()->expectsJson()) {
                return response('Login Successful', 200);
            }
            return redirect()->intended($this->redirectPath());
        }

        if (request()->expectsJson()) {
            return response('Your credentials are incorrect', 400);
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'email' => 'Either your email or password is not correct.',
            ]);
        }
    }
