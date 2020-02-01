<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use SortOrdering;
    protected $appends = ['path', 'VideoUrl', 'hasVideo'];
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

    public function path()
    {
        return '/api/' . $this->slug ;
    }

    public function getPathAttribute()
    {
        return $this->path();
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

    public function getVideoUrlAttribute()
    {
        return $this->getVideoUrl();
    }

    public function hasVideo()
    {
        return !! $this->video;
    }

    public function getHasVideoAttribute()
    {
        return $this->hasVideo();
    }

    public function isBilled()
    {
        return !! $this->billable;
    }
}
