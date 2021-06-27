<?php

namespace App;

use App\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function taggable() {
        return $this->hasMany(Taggable::class);
    }

    public function clients() {
        return $this->taggable()->where('taggable_type','App\Client');
    }
}
