<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        Subject::create([
            'name' => request('name')
        ]);
    }

    public function getSubjects()
    {
        $subjects = Subject::all();
        return $subjects;
    } 
}
