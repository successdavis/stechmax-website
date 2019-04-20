<?php

namespace App\Filters;

use App\Difficulty;
use App\User;

class CourseFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['amount', 'alphabet', 'difficulty'];

    protected function amount($amount = 'desc')
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('amount', $amount);
    }

    protected function alphabet($alphabet)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('title', $alphabet);    
    }

    protected function difficulty($difficulty)
    {
        $this->builder->getQuery()->orders = [];
        $difficulty = Difficulty::firstOrFail()->where('level', $difficulty)->get();
        return $this->builder->where('difficulty_id', $difficulty[0]['id']);
    }

}
