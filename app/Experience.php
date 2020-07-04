<?php

namespace App;

use App\Events\UserEarnedExperience;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public function user()
    { 
        return  $this->belongsTo('App\User');
    }
    


    public function experienceLevel()
    {
        return $this->points;
    }
}
