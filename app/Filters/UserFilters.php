<?php

namespace App\Filters;

use App\User;

class UserFilters extends Filters
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
        return $this->builder->where('f_name', 'LIKE', '%' . $s . '%')
            ->orWhere('m_name', 'LIKE', '%' . $s . '%')
            ->orWhere('l_name', 'LIKE', '%' . $s . '%')
            ->orWhere('user_id', 'LIKE', '%' . $s . '%');
    }

}
