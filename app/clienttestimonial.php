<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clienttestimonial extends Model
{
    protected $guarded = [];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
