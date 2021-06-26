<?php

namespace App;

use App\Newsletterdispatcher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    public function dispatchedTo() {
        return $this->hasMany(Newsletterdispatcher::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
