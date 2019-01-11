<?php

namespace App\Filters;

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
        return $this->builder->where('difficulty', $difficulty);    
    }

}
