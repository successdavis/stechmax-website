<?php

namespace App\Http\Controllers\Auth;

use Twilio;
use App\Http\Controllers\Controller;
use App\Mail\PleaseConfirmYourEmail;
use App\Rules\Recaptcha;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Zttp\Zttp;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register/comfirm_email';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        dd('here');
        return Validator::make($data, [
            'emailOrPhone' => 'required|unique:users,email|emailorphone',
            'surname' => 'required|string|max:50|min:3',
            'lastname' => 'required|string|max:50|min:3',
            'middlename' => 'string|max:50',
            'gender' => 'required|string|max:1',
            'dateofbirth' => 'required|max:255',
            'password' => 'required|string|min:8|confirmed',
            // 'token' => ['required', new Recaptcha()],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        do {
            $token = str_random(25);
        } while ( user::where('confirmation_token', $token)->exists());

        do {
            $username = $data['surname'] . $data['lastname'] . rand(2,5);
        } while ( user::where('confirmation_token', $username)->exists());

        $storeData = [
            'f_name' => $data['surname'],
            'l_name' => $data['lastname'],
            'm_name' => $data['middlename'],
            'dob' => $data['dateofbirth'],
            'username' => $username,
            'gender' => $data['gender'],
            'confirmation_token' => str_limit(md5($data['emailOrPhone'] . str_random()), 25, ''),
            'password' => Hash::make($data['password']),
        ];

        if (ctype_digit($data['emailOrPhone'])) {
            $storeData['phone'] = $data['emailOrPhone'];
        }else {
            $storeData['email'] = $data['emailOrPhone'];
        };

        return User::create($storeData);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($user)->send(new PleaseConfirmYourEmail($user));
            return redirect($this->redirectPath());
        };

        $user->smartSendToken();
    }
}
