<?php

namespace App\Filters;

use App\User;
use App\Course;

class TestimonialFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['approve'];

    protected function approve()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('approve', true);
    }
}
