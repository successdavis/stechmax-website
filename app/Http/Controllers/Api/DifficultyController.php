<?php

namespace App\Http\Controllers\Api;

use App\Difficulty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DifficultyController extends Controller
{
    public function index()
    {
        $difficulties = Difficulty::all();

        return $difficulties;
    }
}
