<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public static function adminFeed($take = 50)
    {
        return static::where('priority', '1')
            ->latest()
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function ($activity){
            return $activity->created_at->format('Y-m-d');
        });
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function feed($user, $take = 50)
    {
        return static::where('user_id', $user->id)->where('priority', 0)
        ->latest()
        ->with('subject')
        ->take($take)
        ->get()
        ->groupBy( function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
