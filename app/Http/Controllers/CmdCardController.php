<?php

namespace App\Http\Controllers;

use App\User;
use App\Subscription;
use PDF;
use Illuminate\Http\Request;

class CmdCardController extends Controller
{
    public function index(User $user)
    {
    	$subscriptions = $user->subscriptions()->with(['subscriber','invoice'])->get();

        $pdf = PDF::loadView('pdfs.studentcard', compact('user','subscriptions'))->setPaper('a5', 'landscape');  
        return $pdf->stream('medium.pdf');
    }

    public function activeusers()
    {
    	$subscriptions = Subscription::activeSubscriptions()->with(['subscriber','invoice','owner'])->get();

    	$pdf = PDF::loadView('pdfs.activeusers', compact('subscriptions'))->setPaper('a4', 'portrait'); 

        return $pdf->stream('activeusers.pdf');
    }
}
