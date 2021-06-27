<?php

namespace App\Traits;

use App\Newsletterdispatcher;
use Illuminate\Database\Eloquent\Model;

trait NewsDispatcher
{
    public function news()
    {
        return $this->morphMany(Newsletterdispatcher::class, 'dispatcher');
    }
}
