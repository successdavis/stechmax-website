<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];
    protected $with = ['lectures'];

    use SortOrdering;

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function lectures()
    {
        return $this->hasMany('App\Lecture')->orderBy('order');
    }
}
