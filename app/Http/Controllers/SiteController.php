<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function getSiteLogo()
    {
    	return asset('storage/site-images/logo.png');
    }

    public function getTemplateLogo()
    {
    	return asset('storage/site-images/templates.png');
    }
}
