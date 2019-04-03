<?php

namespace App\Http\Controllers\Api;

use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();

        return $types;
    }
}
