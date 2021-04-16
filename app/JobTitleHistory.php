<?php

namespace App;

use App\Jobtitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitleHistory extends Model
{
    use HasFactory;

    public function jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
}
