<?php

namespace App\Http\Controllers;

use App\Experience;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class RankingController extends Controller
{
    public function index()
    {

        $order = 'desc';
        $users = User::whereHas('subscriptions', function(Builder $query) {
            return $query->where('active',true);
        })->withSum('Experience as total_points', 'points')->orderBy('total_points','desc')->get()
        ->groupBy(function($user) {
                return $user->created_at->format('m');
            });

        return view('dashboard.users.batch_rankings', compact('users'));
    }

    public function rankings()
    {

        $order = 'desc';
        $users = User::whereHas('subscriptions', function(Builder $query) {
            return $query->where('active',true);
        })->withSum('Experience as total_points', 'points')->orderBy('total_points','desc')->get();

        return view('dashboard.users.rankings', compact('users'));
    }


}
