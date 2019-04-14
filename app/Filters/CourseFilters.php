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
    protected $filters = ['fee', 'alphabet', 'difficulty'];

    protected function fee($fee = 'desc')
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('fee', $fee);
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
