<?php

namespace App\Http\Controllers;

use App\Course;
use App\Learn;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Course $course, Request $request)
    {
        $this->validate(request(), [
            'body' => 'required|spamfree',
        ]);
        
        $learn = Learn::add([
            'body' => ucfirst(request('body')),
            'course_id' => $course->id
        ], $course);
        return $learn;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Learn  $learn
     * @return \Illuminate\Http\Response
     */
    public function show(Learn $learn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Learn  $learn
     * @return \Illuminate\Http\Response
     */
    public function edit(Learn $learn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learn  $learn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Learn $learn)
    {
        $learn->update([
            'body' => request('body')
        ]);
    }

    public function reOrderLearns(Course $course)
    {
        $originalLearns = $course->learns;

        foreach ($originalLearns as $oLearn) {
            $id = $oLearn->id;
            foreach (request()->learns as $newLearn) {
                if ($id === $newLearn['id']) {
                    $oLearn->update([
                        'order' => $newLearn['order'] 
                    ]);
                }
            }
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Learn  $learn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Learn $learn)
    {
        $learn->delete();
    }

    public function getLearns(Course $course)
    {
        $learns = $course->learns()->orderBy('order')->get();

        return $learns;
    }
}
