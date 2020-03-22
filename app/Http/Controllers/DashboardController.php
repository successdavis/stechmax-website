<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Subscription;
use App\User;
use App\payments;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $accountId = 'AC79bf320fcabfb44c14ee98fc369427fe';
//        $token = 'ddd857b8eca96328112b241b15cfd106';
//        $fromNumber = '+17204596176';
//
//        $twilio = new \Aloha\Twilio\Twilio($accountId, $token, $fromNumber);
//        $twilio->call('+2348076727008', 'http://foo.com/call.xml');

//        $twilio->message('+2348076727008', 'Pink Elephants and Happy Rainbows');

        $totalUsers = User::totalUsers();
        $totalUsersWithSub = User::totalUsersWithSub();
        $countActiveSub = Subscription::countActiveSub();
        $monthlyTotalPay = payments::monthlyTotalPay();
        $yearTotalPay = payments::yearTotalPay();
        return view('dashboard.index', compact('totalUsers','totalUsersWithSub','countActiveSub','monthlyTotalPay','yearTotalPay'));
    }
}
