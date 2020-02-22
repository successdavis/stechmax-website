<?php

namespace App\Filters;

use App\Type;
use App\Difficulty;
use App\User;

class CourseFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['amount', 'alphabet', 'difficulty', 'search', 'type'];

    protected function amount($amount = 'desc')
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('amount', $amount);
    }

    protected function type($type = '')
    {
        $this->builder->getQuery()->orders = [];
        
        if (! Type::where('name', $type)->exists()) {
            abort(400, 'Bad Request');
        }

        $type = Type::where('name', $type)->get();

        return $this->builder->where('type_id', $type[0]['id']);
    }

    protected function alphabet($alphabet)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('title', $alphabet);    
    }

    protected function difficulty($difficulty)
    {
        $this->builder->getQuery()->orders = [];
        if (! Difficulty::where('level', $difficulty)->exists()) {
            abort(400, 'Bad Request');
        }

        $difficulty = Difficulty::where('level', $difficulty)->get();

        return $this->builder->where('difficulty_id', $difficulty[0]['id']);
        
    }

    public function search($s)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('title', 'LIKE', '%' . $s . '%');
            // ->orWhere('description', 'LIKE', '%' . $s . '%');
    }

}
