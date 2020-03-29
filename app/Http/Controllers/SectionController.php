<?php

namespace App\Http\Controllers;

use App\Course;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Resources\SectionResource;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $sections = $course->sections;

        return SectionResource::collection($sections);
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
        $this->validate(request(), [
           'title' => 'required|spamfree'
        ]);

        $section = Section::add([
            'title' => request('title'),
            'course_id' => $course->id,
            'description' => request('description')
        ], $course);

        return $section;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Section $section)
    {
        $this->validate(request(), [
            'title' => 'required|spamfree'
        ]);

        $section->update([
            'title' => request('title'),
            'description' => request('description')
        ]);
    }


    public function reOrderSections(Course $course)
    {
        $originalSections = $course->sections;

        foreach ($originalSections as $oSection) {
            $id = $oSection->id;
            foreach (request()->sections as $newSection) {
                if ($id === $newSection['id']) {
                    $oSection->update([
                        'order' => $newSection['order'] 
                    ]);
                }
            }
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
    }

    public function getSections(Course $course)
    {
        $sections = $course->sections()->orderBy('order')->get();

        return $sections;
    }
}
