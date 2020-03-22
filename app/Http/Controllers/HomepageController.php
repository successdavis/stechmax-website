<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\subjectResource;
use App\Subject;
use App\Testimonial;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = \App\Type::find(4);
        
        $programs = !empty($type) ? $type->courses()->get() : [];
        $testimonials = Testimonial::where('approve', true)->limit(25)->get();
        // $streamerCourses = Course::inRandomOrder()->whereType_id('2')->get()->take('3');

        $subjects = Subject::All();
        $subjectWithCounts = [];

        foreach ($subjects as $subject) {
            $subjectWithCounts[$subject->slug] = [
                'courseCount' => $subject->coursesCount(),
                'trackCount' => $subject->trackCount()
            ];
        };

        return view('welcome', compact('programs','subjectWithCounts','testimonials'));
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
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
