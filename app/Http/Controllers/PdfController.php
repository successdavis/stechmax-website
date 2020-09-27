<?php

namespace App\Http\Controllers;

use App\User;
use App\Subscription;
use PDF;
use App\Course;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(User $user)
    {
    	$subscriptions = $user->subscriptions()->with(['subscriber','invoice'])->get();

        $pdf = PDF::loadView('pdfs.studentcard', compact('user','subscriptions'))->setPaper('a4', 'portrait');
        return $pdf->stream('medium.pdf');
    }

    public function activeusers()
    {
    	$subscriptions = Subscription::activeSubscriptions()->with(['subscriber','invoice','owner'])->get();

    	$pdf = PDF::loadView('pdfs.activeusers', compact('subscriptions'))->setPaper('a4', 'portrait');

        return $pdf->stream('activeusers.pdf');
    }

    public function outline(Course $course){
        if (strtolower($course->type->name) != 'course') {
            $linked_courses = $course->childrenCourses()->orderBy('order')->get();
            $pdf = PDF::loadView('pdfs.track-outline', compact('linked_courses', 'course'))->setPaper('a4', 'portrait');

            return $pdf->stream($course->type->name . '-outline.pdf');
        }

        $sections = $course->sections;

    	$pdf = PDF::loadView('pdfs.course-outline', compact('sections', 'course'))->setPaper('a4', 'portrait');

        return $pdf->stream('course-outline.pdf');

    }
}
