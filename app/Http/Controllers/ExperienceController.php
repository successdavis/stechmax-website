<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function award(Request $request, User $user)
    {
    	$request->validate([
    		'points' 		=> 'required|int',
    		'description'	=> 'required|string'
    	]);

    	$user->awardExperience(request()->points,request()->description);
    }

    public function strip(Request $request, User $user)
    {
    	$request->validate([
    		'points' 		=> 'required|int',
    		'description'	=> 'required|string'
    	]);

    	$user->stripExperience(request()->points,request()->description);
    }
}
