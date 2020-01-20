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

        // Parameters
        $x          = 505;
        $y          = 790;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
        $size       = 10;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $pdf->getCanvas()->page_text(
          $x, $y, $text, $size, $color, $word_space, $char_space, $angle
        );

        return $pdf->stream('activeusers.pdf');
    }
}
