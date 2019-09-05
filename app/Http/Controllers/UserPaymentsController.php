<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.payments.index', [
            'displayMenu' => true
        ]);
    }

    public function getDataForDataTable(User $user)
    {
         $subscriptions = Course::WhereSubscribeBy($user)->get();
         return UserPaymentsResource::collection($subscriptions);
    }
}
