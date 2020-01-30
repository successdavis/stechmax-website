<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use SortOrdering;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($lecture) {
            $lecture->update(['slug' => $lecture->title]);
        });
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
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
        	return asset('storage/' . $this->video->url);
        }

        return response('Sorry! This lecture has no associate video', 422);
    }

    public function isBilled()
    {
        return !! $this->billable;
    }
}
