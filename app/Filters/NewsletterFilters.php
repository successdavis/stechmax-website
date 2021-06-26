<?php

namespace App\Filters;

use App\Course;
use Illuminate\Http\Request;

class NewsletterFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['sendTo'];

    protected function sendTo($s)
    {

        return $builder::where('fullname', 'LIKE', '%' . $s . '%')
            ->orWhere('phone', 'LIKE', '%' . $s . '%');
    }

}
