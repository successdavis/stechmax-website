<?php

namespace App\Traits;

use App\Taggable;
use Illuminate\Database\Eloquent\Model;

trait Hastags
{
    public function tags()
    {
        return $this->morphMany(Taggable::class, 'taggable');
    }

    public function getAssociatedTags() {
        return $this->tags->map(
            function($tag){ 
                return $tag->tag;
            }
        );
    }
}
