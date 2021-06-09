<?php

namespace App\Http\Controllers;

use App\Course;
use App\Section;
use App\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        $lectures = $section->lectures()->orderBy('order')->get();;

        return $lectures;
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
    public function store(Section $section)
    {
        $this->validate(request(), [
            'title' => 'required|spamfree'
        ]);

        $lecture = Lecture::addLecture([
            'title' => request('title'),
            'section_id' => $section->id,
            'course_id' => $section->course->id,
        ], $section);

        return $lecture;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Lecture $lecture)
    {
        $course = $lecture->section->course;

        // $this->authorize('view', $lecture);

        $nextepisode = $lecture->nextLectureUrl();
        $prevepisode = $lecture->prevLectureUrl();

       $sections = $course->sections;

        if ($lecture->hasVideo()) {
            return view('courses/lecture/index', compact('lecture','nextepisode','prevepisode','course','sections'));
        }

        return back()->withFlash('This lesson has no associate video','failed');
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
    public function update(Lecture $lecture)
    {
        $this->validate(request(), [
            'title' => 'required|spamfree'
        ]);
           
        $lecture->update([
            "title" => request('title')
        ]);
    }

    public function reOrderLectures(Section $section)
    {
        $originalLectures = $section->lectures;

        foreach ($originalLectures as $oLectures) {
            $id = $oLectures->id;
            foreach (request()->lectures as $newLecture) {
                if ($id === $newLecture['id']) {
                    $oLectures->update([
                        'order' => $newLecture['order'] 
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
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
    }

    public function savenote(Lecture $lecture, Request $request)
    {
        request()->validate([
            'lecturenote'   => 'required'
        ]);

        $lecture->notes = $request->lecturenote;
        $lecture->save();
    }
}
