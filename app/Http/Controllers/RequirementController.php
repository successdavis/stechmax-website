<?php

namespace App\Http\Controllers;

use App\Course;
use App\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
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
    public function store(Course $course)
    {
        $this->validate(request(), [
            'body' => 'required|spamfree'
        ]);

        $requirement = Requirement::add([
            'body' => request('body'),
            'course_id' => $course->id
        ], $course);

        return $requirement;
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
    public function update(Requirement $requirement)
    {
        $requirement->update([
            'body' => request('body')
        ]);
    }

    public function reOrderRequirements(Course $course)
    {
        $originalRequirement = $course->requirements;

        foreach ($originalRequirement as $oRequirement) {
            $id = $oRequirement->id;
            foreach (request()->requirements as $newRequirement) {
                if ($id === $newRequirement['id']) {
                    $oRequirement->update([
                        'order' => $newRequirement['order'] 
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
    public function destroy(Requirement $requirement)
    {
        $requirement->delete();
    }

    public function getRequirements(Course $course)
    {
        $requirements = $course->requirements()->orderBy('order')->get();

        return $requirements;
    }
}
