<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    static public function getClassroomFee()
    {
    	return self::where('item', 'Classroom')->pluck('amount')->first();
    }

    static public function getSpecialProgramFee()
    {
    	return self::where('item', 'Special Program')->pluck('amount')->first();
    	
    }
    
    static public function getHandoutFee()
    {
    	return self::where('item', 'Handout')->pluck('amount')->first();
    	
    }
}
