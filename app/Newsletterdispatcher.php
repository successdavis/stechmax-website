<?php

namespace App;

use App\Newsletter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletterdispatcher extends Model
{
    use HasFactory;

    public function dispatcher () {
        return $this->morphTo();
    }

    public function newsletter() {
        return $this->belongsTo(Newsletter::class);
    }

    public function getDispatcherChannel() {
        $reflection = new ReflectionClass($this->dispatcher_type);
        
        return $reflection->getShortName();

    }
}
