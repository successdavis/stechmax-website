<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class StudyRoomController extends Controller
{
    public function index(Course $course)
    {
    	$sections = $course->getSections();
    	return view('studyroom.index', compact('course','sections'));
    }
}
