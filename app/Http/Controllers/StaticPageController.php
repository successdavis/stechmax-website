<?php

namespace App\Http\Controllers;

use App\clienttestimonial;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function websiteDesign()
    {
        $clienttestimonial = clienttestimonial::limit(10)->get();
    	return view('websiteservice.index', compact('clienttestimonial'));
    }
}
