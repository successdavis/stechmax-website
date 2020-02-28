<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by', 'popular', 'unanswered', 'search', 'solved', 'unsolved', 'participation', 'bestanswer'];

    /**
     * Filter the query by a given username.
     *
     * @param  string $username
     * @return Builder
     */
    protected function by($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    public function search($s)
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->where('title', 'LIKE', '%' . $s . '%');
            // ->orWhere('description', 'LIKE', '%' . $s . '%');
    }

    public function unanswered()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->doesntHave('replies');
    }

    public function solved()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->wherenotNull('best_reply_id');
    }

    public function unsolved()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->whereNull('best_reply_id');
    }

    public function participation()
    {
        $user = auth()->user();

        $this->builder->getQuery()->orders = [];
        return $this->builder->whereHas('replies', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
