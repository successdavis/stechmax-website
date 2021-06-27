<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dispatcher () {
        return $this->morphTo();
    }

    public function tags() {
        return $this->belongsTo(Tag::class);
    }
}
