<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];
    protected $with = ['topics'];
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function addTopic($topic) {
        $topic = $this->topics()->create($topic);

        return $topic;
    }
}
