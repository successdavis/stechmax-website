<?php

namespace App;

use Carbon\Carbon;

trait SortOrdering
{
    static public function add($resource, $course = null)
    {
        $order = 1;
        if(static::whereCourse_id($course->id)->whereOrder($order)->exists()){
            $order = self::incrementOrder($order, $course->id);
        }
        $resource['order'] = $order;

        $resource = self::create($resource);

        return $resource;
    }

    static public function incrementOrder($order, $course_id)
    {
        while(static::whereCourse_id($course_id)->whereOrder($order)->exists()) {
            $order++;
        }

        return $order;
    }

// AM REPEATING CODE HERE AND IT NEEDS REFACTORING BUT FOR NOW LET JUST GET TO GREEN

    static public function addLecture($resource, $section = null)
    {
        $order = 1;
        if(static::whereSection_id($section->id)->whereOrder($order)->exists()){
            $order = self::incrementLectureOrder($order, $section->id);
        }
        $resource['order'] = $order;

        $resource = self::create($resource);

        return $resource;
    }

    static public function incrementLectureOrder($order, $section_id)
    {
        while(static::whereSection_id($section_id)->whereOrder($order)->exists()) {
            $order++;
        }

        return $order;
    }
}
