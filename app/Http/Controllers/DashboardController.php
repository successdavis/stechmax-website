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
        $totalUsers = User::totalUsers();
        $totalUsersWithSub = User::totalUsersWithSub();
        $countActiveSub = Subscription::countActiveSub();
        $monthlyTotalPay = payments::monthlyTotalPay();
        $yearTotalPay = payments::yearTotalPay();
        $experiences = auth()->user()->experience()->latest()->limit(10)->get();
        $mostRecentUsers = User::latest()->limit(10)->get();
        return view('dashboard.index', compact('totalUsers','totalUsersWithSub','countActiveSub','monthlyTotalPay','yearTotalPay','experiences', 'mostRecentUsers'));
    }
}
