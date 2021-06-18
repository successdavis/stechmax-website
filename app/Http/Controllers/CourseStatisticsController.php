<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseStatisticsController extends Controller
{
    public function index(Course $course)
    {
        $subscribers        = $course->subscriptions()->orderBy('active','desc')->get();
        $activeSubscribers  = $course->subscriptions()->where('active', true)->count();
        $total = $course->subscriptions->count();
        $totalEarning = 0;
        foreach ($subscribers as $subscriber) {
            $totalEarning += $subscriber->invoice->totalPayments();
        }

        $totalEarning = str_replace('-','', $totalEarning / 100);

        return view('dashboard.courses.statistics', compact([
            'displayMenu' => true,
            'activeSubscribers',
            'subscribers',
            'total',
            'totalEarning'
        ]));

    }
}
