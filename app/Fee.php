<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use Billable;

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

    static public function getCertificateFee()
    {
    	return self::where('item', 'Certificate')->pluck('amount')->first();

    }

    static public function graduationCeremonyFee()
    {
    	return self::where('item', 'Graduation Ceremony')->pluck('amount')->first();

    }
}
