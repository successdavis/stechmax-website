<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Http\Resources\SubscriptionResource;
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
        $subscriptions = $user->subscriptions()->get();
    	return SubscriptionResource::collection($subscriptions);
    	// return CourseSubscriptionsResource::collection($subscriptions);
    }
}
