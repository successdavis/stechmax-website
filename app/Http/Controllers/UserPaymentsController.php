<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoicesResource;
use App\Http\Resources\UserPaymentsResource;
use App\User;
use App\payments;
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
         $invoices = $user->invoices()->get();
         return InvoicesResource::collection($invoices);
    }
}
