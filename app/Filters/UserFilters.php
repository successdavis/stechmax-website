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
    protected $filters = ['search','idno'];

    protected function search($s)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where(function ($query) use ($s) {
            $query->where('f_name', 'LIKE', '%' . $s . '%')
            ->orWhere('m_name', 'LIKE', '%' . $s . '%')
            ->orWhere('l_name', 'LIKE', '%' . $s . '%')
            ->orWhere('user_id', 'LIKE', '%' . $s . '%');
        });
    }

    protected function idno($idno)
    {
        return $this->builder->where('user_id',$idno);
    }

}
