<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learn extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
