<?php

namespace App;

use App\JobTitleHistory;
use App\Paygrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function history()
    {
        return $this->hasMany(JobTitleHistory::class);
    }

    public function employees()
    {
        return $this->hasMany(User::class, 'emp_id');
    }

    public function paygrade()
    {
        return $this->hasMany(Paygrade::class);
    }
}
