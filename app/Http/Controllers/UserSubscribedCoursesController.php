<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Http\Resources\CourseSubscriptionsResource;
use Illuminate\Http\Request;

class UserSubscribedCoursesController extends Controller
{
    public function index(User $user)
    {
    	return view('dashboard.users.mycourses', [
            'displayMenu' => true
        ]);
    }

    public function getDataForDataTable(User $user)
    {
    	 $subscriptions = Course::WhereSubscribeBy($user)->get();
    	 return CourseSubscriptionsResource::collection($subscriptions);
    }
}
