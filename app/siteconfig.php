<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siteconfig extends Model
{
    static public function getclassroomfee()
    {
    	return self::first()->classroom_fee;
    }
}
