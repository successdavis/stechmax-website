<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use SortOrdering;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function video()
    {
    	return $this->hasOne(Video::class);
    }

    public function getVideoUrl()
    {
        if ($this->video) {
        	return $this->video->url;
        }

        return response('Sorry! This lecture has no associate video', 422);
    }

    public function isBilled()
    {
        return !! $this->billable;
    }
}
