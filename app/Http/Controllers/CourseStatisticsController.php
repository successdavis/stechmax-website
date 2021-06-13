<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseStatisticsController extends Controller
{
    public function index(Course $course)
    {
        $subscribers        = $course->subscriptions;
        $activeSubscribers  = $course->subscriptions->where('active')->count();
        $total = $course->subscriptions->count();
        $totalEarning = 0;
        foreach ($subscribers as $subscriber) {
            $totalEarning += $subscriber->invoice->amount;
        }

        return view('dashboard.courses.statistics', compact([
            'displayMenu' => true,
            'activeSubscribers',
            'subscribers',
            'total',
            'totalEarning'
        ]));

    }
}
