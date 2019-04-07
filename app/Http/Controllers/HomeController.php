<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('Dashboard.home', [
            'displayMenu' => true]);
    }

    public function subscribedCourses(User $user)
    {
        $courses = $user->getSubscribedCourses()->get();
        return view('Dashboard.courses', [
            'pageTitle' => 'Dashboard - Stechmax',
            'displayMenu' => 'Gansters School',
            'subscribedCourses' => $courses
        ]);
    }
}
