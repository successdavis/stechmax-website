<?php

namespace App;

use App\Business;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    public function business()
    {
    	return $this->belongsTo(Business::class);
    }
}
