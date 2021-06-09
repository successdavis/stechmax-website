<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lecture extends Model
{
    use SortOrdering;
    protected $appends = ['hasVideo','videoUrl'];
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
        return '/'. $this->course->slug . '/episode/' . $this->slug;
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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    

    public function getVideoUrl()
    {
        if ($this->hasVideo) {
        	return $this->video_path;
        }
    }

    public function getVideoUrlAttribute()
    {
        return $this->getVideoUrl();
    }

    public function hasVideo()
    {
        return !! $this->video_path;
    }

    public function getHasVideoAttribute()
    {
        return $this->hasVideo();
    }

    public function isBilled()
    {
        return !! $this->billable;
    }

    public function nextLectureUrl()
    {
        $nextlecture = self::orderby('id')->where('id', '>', $this->id)->where('section_id', $this->section_id)->first();

        if ($nextlecture) {
            return '/'. $this->course->slug . '/episode/' . $nextlecture->slug;
        }

        return null;
    }

    public function prevLectureUrl()
    {
        $prevlecture = self::orderby('id')->where('id', '<', $this->id)->where('section_id', $this->section_id)->first();

        if($prevlecture) {
            return '/'. $this->course->slug . '/episode/' . $prevlecture->slug;
        }

        return null;

    }
}
