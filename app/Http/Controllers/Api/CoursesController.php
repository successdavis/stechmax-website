<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Filters\CourseFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Subject;
use App\Type;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index ()
    {
        return view('dashboard.courses.index', [
            'displayMenu' => true
        ]);
    }

    public function getCourses()
    {
        $courses = Type::find(1)->courses;
        return $courses;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

    public function getCoursesForDataTable(Request $request, CourseFilters $filter)
    {
        $filter = Course::filter($filter);

        $query = $filter->orderBy($request->column, $request->order);
        $courses = $query->paginate($request->per_page);

        return CourseResource::collection($courses);
    }

    public function allcoursesandtracks()
    {
        $courses = Course::latest()->get();

        return $courses;
    }

    public function getSubjectCourses()
    {
        return $users = Course::whereIn('subject_id', request('subjects'))->get();
    }
}
