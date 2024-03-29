<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use SortOrdering;
    
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
