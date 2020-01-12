<?php

namespace App\Http\Controllers;

use App\Lecture;
use App\video;
use Illuminate\Http\Request;

class VideoController extends Controller
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
    public function store(Request $request, Lecture $lecture)
    {
        dd('here');
        abort(422, 'URL Under maintenance');
        if (! auth()->user()->isAdmin()) {
            abort(403,'You do not have access to carry out this request');
        }

        $request->validate([
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'
        ]);

        // $lecture->video()->create([
        //     'duration' => 
        // ]);

        $lecture->update([
            'url' => request()->file('video')->storeAs('promovideo', $course->title, 'public')
        ]);

        return response($course->video_path, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        // $course = $lecture->section->course;
        // $this->authorize('show', $course); 

        // if (!empty($lecture->video()->get())) {
        //     return $lecture->getVideoUrl();
        // }

        // abort(403, 'This lesson has no associated video');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(video $video)
    {
        //
    }
}
