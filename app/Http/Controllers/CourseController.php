<?php

namespace App\Http\Controllers;

use App\Type;
use App\Course;
use App\Subject;
use Illuminate\Http\Request;
use App\Filters\CourseFilters;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subject $subject, CourseFilters $filters)
    {
        $courses = $this->getCourses($subject, $filters)->take('10');
        $tracks = Type::getCourseByType('track')->get()->take('10');
        $subjects = Subject::all();

        if (request()->wantsJson()) {
            return $courses;
        }

        return view('courses.index', compact('courses','tracks','subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create', [
            'displayMenu' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|spamfree',
            'duration' => 'required',
            'fee' => 'required',
            'description' => 'required',
            'sypnosis' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'type_id' => 'required|exists:types,id',
            'difficulty_id' => 'required|exists:difficulties,id'
        ]);

        $course = Course::create([
            'title' => request('title'),
            'duration' => request('duration'),
            'subject_id' => request('subject_id'),
            'difficulty_id' => request('difficulty_id'),
            'type_id' => request('type_id'),
            'fee' => request('fee'),
            'description' => request('description'),
            'sypnosis' => request('sypnosis')
        ]);

        if (request()->expectsJson()) {
            return $course;
        }

        return redirect($course->path())
            ->with('flash', 'New Course Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($subjectId, Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function getCourses($subject, $filters)
    {
        $courses = Course::latest()->filter($filters);

        if ($subject->exists) {
            $courses->where('subject_id', $subject->id);
        }

        return $courses = $courses->get();
    }
}
