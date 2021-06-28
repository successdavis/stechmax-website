<?php

namespace App\Http\Controllers;

use App\payments;
use Illuminate\Http\Request;

class IncomeStatementController extends Controller
{
    public function index()
    {
        $payments = payments::incomeStatementFeed();
        return view('dashboard/payments/incomestatement', compact('payments'));
    }
}
