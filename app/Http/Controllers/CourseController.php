<?php

namespace App\Http\Controllers;

use Paystack;
use App\Type;
use App\Course;
use App\Subject;
use App\Http\Resources\CourseResource;
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
        $courses = $this->getCourses($subject, $filters);
        $subjects = Subject::all();


        if (request()->wantsJson()) {
            return CourseResource::collection($courses);
        }

        return view('courses.index', compact('courses','subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.courses.create', [
            'displayMenu' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|spamfree',
            'duration' => 'required',
            'description' => 'required',
            'sypnosis' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'type_id' => 'required|exists:types,id',
            'difficulty_id' => 'required|exists:difficulties,id'
        ]);

        $course = Course::create(request()->all());

        $course->createPlanOnPaystack();

        // $path = $course->path();

        if (request()->expectsJson()) {
            return ['course' => $course, 'path' => $course->path()];
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
            // dd($course->childrenCourses()->get());
        if (strtolower($course->type->name) === 'program') {
            $linked_courses = $course->childrenCourses()->orderBy('order')->get();
            return view('courses.program.index', compact('course', 'linked_courses'));
        }

        if (strtolower($course->type->name) === 'track') {
            $linked_courses = $course->childrenCourses()->orderBy('order')->get();
            // dd($linked_courses);
            return view('courses.track.index', compact('course', 'linked_courses'));
        }

        $sections = $course->sections;

        return view('courses.show', compact('course', 'sections'));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('dashboard.courses.manage', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course)
    {
        $course->update(request()->validate([
            'title' => 'required|spamfree',
            'description' => 'required|spamfree',
            'duration' => 'required',
            'subject_id' => 'required',
            'amount' => 'required|integer',
            'sypnosis' => 'required|spamfree',
            'difficulty_id' => 'required'
        ]));
    }

    public function publish(Course $course)
    {
        $course->publish();

        return back()
            ->with('flash', 'This course is now visible to users');
    }

    public function unPublish(Course $course)
    {
        $course->unPublish();
        return back()
            ->with('flash', 'This course is nolonger visible to users');
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
        $courses = Course::latest()->filter($filters)->where('published', true);

        if ($subject->exists) {
            $courses->where('subject_id', $subject->id);
        }

        return $courses = $courses->get();
    }
}
