<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\subjectResource;
use App\Subject;
use App\Testimonial;
use Illuminate\Http\Request;

class LearningHomepageController extends Controller
{
    public function index()
    {
        $type = \App\Type::find(4);
        
        $programs = !empty($type) ? $type->courses()->whereShowcase(true)->get() : [];
        $testimonials = Testimonial::where('approve', true)->limit(25)->get();
        // $streamerCourses = Course::inRandomOrder()->whereType_id('2')->get()->take('3');

        $subjects = Subject::All();
        $subjectWithCounts = [];

        foreach ($subjects as $subject) {
            $subjectWithCounts[$subject->slug] = [
                'courseCount' => $subject->coursesCount(),
                'trackCount' => $subject->trackCount()
            ];
        };

        return view('welcome', compact('programs','subjectWithCounts','testimonials'));
    }
}
