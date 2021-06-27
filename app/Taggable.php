<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function taggable () {
        return $this->morphTo();
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
