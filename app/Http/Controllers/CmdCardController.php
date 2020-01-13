<?php

namespace App\Http\Controllers;

use App\User;
use PDF;
use Illuminate\Http\Request;

class CmdCardController extends Controller
{
    public function index(User $user)
    {
        $pdf = PDF::loadView('pdfs.studentcard', compact('data'))->setPaper('a5', 'landscape');  
        return $pdf->stream('medium.pdf');
    }
}
