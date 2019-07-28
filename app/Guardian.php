<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
	protected $guarded = [];

    public function Users()
    {
    	$this->belongsTo(User::class);
    }
}
