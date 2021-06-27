<?php

namespace App;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function taggable() {
        return $this->hasMany(Taggable::class);
    }
}
