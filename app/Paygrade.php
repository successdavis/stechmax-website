<?php

namespace App;

use App\Jobtitle;
use App\PaygradeHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paygrade extends Model
{
    use HasFactory;

    public function jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pagradeHistory()
    {
        return $this->hasMany(PaygradeHistory::class);
    }
}
