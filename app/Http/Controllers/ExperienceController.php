<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request, User $user)
    {
    	$request->validate([
    		'points' 		=> 'required|int',
    		'description'	=> 'required|string'
    	]);

    	$user->awardExperience(request()->points,request()->description);
    }
}
