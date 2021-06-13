<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseStatisticsController extends Controller
{
    public function index(Course $course)
    {
        $subscribers = $course->subscriptions;
        $monthTotal = $course->subscriptions->count();
        $total = $course->subscriptions->count();
        $totalEarning = 0;
        foreach ($subscribers as $subscriber) {
            $totalEarning += $subscriber->invoice->amount;
        }

        return view('dashboard.courses.statistics', compact([
            'displayMenu' => true,
            'subscribers',
            'monthTotal',
            'total',
            'totalEarning'
        ]));

    }
}
