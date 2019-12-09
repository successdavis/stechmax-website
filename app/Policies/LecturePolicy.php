<?php

namespace App\Policies;

use App\User;
use App\Lecture;
use Illuminate\Auth\Access\HandlesAuthorization;

class LecturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lecture.
     *
     * @param  \App\User  $user
     * @param  \App\Lecture  $lecture
     * @return mixed
     */
    public function view(User $user, Lecture $lecture)
    {
        $course = $lecture->section->course;

         return ($course->isSubscribedBy($user));
    }

    /**
     * Determine whether the user can create lectures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the lecture.
     *
     * @param  \App\User  $user
     * @param  \App\Lecture  $lecture
     * @return mixed
     */
    public function update(User $user, Lecture $lecture)
    {
        //
    }

    /**
     * Determine whether the user can delete the lecture.
     *
     * @param  \App\User  $user
     * @param  \App\Lecture  $lecture
     * @return mixed
     */
    public function delete(User $user, Lecture $lecture)
    {
        //
    }

    /**
     * Determine whether the user can restore the lecture.
     *
     * @param  \App\User  $user
     * @param  \App\Lecture  $lecture
     * @return mixed
     */
    public function restore(User $user, Lecture $lecture)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the lecture.
     *
     * @param  \App\User  $user
     * @param  \App\Lecture  $lecture
     * @return mixed
     */
    public function forceDelete(User $user, Lecture $lecture)
    {
        //
    }
}
