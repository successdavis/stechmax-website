<?php

namespace App\Filters;

use App\User;

class ClientFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['search'];

    protected function search($s)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('fullname', 'LIKE', '%' . $s . '%')
            ->orWhere('phone', 'LIKE', '%' . $s . '%');
    }

}
