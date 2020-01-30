<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded =[];

    public function lecture()
    {
    	return $this->hasOne(Lecture::class);
    }
}
