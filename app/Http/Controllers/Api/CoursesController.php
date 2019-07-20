<?php

namespace App\Http\Controllers\Api;

use App\Type;
use App\Course;
use App\Subject;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
     public function index ()
    {
        return view('dashboard.courses.index', [
            'displayMenu' => true
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function getSubjects()
    {
        $subjects = Subject::all();
        return $subjects;
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

    public function getCoursesForDataTable(Request $request)
    {
        $query = Course::orderBy($request->column, $request->order);
        if ($request->has('published') && strtolower($request->published) != "all") {
            $query->wherePublished(
                    filter_var($request->published, FILTER_VALIDATE_BOOLEAN)
                );
        }

        if ($request->has('type_id') && strtolower($request->type_id) != "all") {
            $query->whereType_id($request->type_id);
        }
        
        $courses = $query->paginate($request->per_page);

        return CourseResource::collection($courses);
    }
}
