<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        //
    }

    public function getTrackCourses(Course $course)
    {
        $courses = $course->childrenCourses()->orderBy('order')->get();
        return $courses;  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course)
    {
        if ($course->childrenCourses()->whereCourse_id(request('id'))->exists()) {
            return response([], 422);
        }

        $trackCourse = Course::find(request('id'));

        $course->attachCourseToTrack($trackCourse);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function reOrderCourses(Course $course)
    {
        $originalCourses = $course->childrenCourses;

        foreach ($originalCourses as $oCourse) {
            $id = $oCourse->id;
            foreach (request()->courses as $newCourse) {
                if ($id === $newCourse['id']) {
                    // $oCourses->updateExistingPivot([
                    //     'order' => $newCourse['order'] 
                    // ]);
                    $course->childrenCourses()->updateExistingPivot($oCourse->id, [
                        'order' => $newCourse['order']
                    ]);
                }
            }
        }    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $removeCourse = Course::find(request('id'));
        $course->detachCourseFromTrack($removeCourse);
    }
}
