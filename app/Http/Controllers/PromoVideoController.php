<?php

namespace App\Http\Controllers;

use App\Course;
use FFMpeg;
use Illuminate\Http\Request;

class PromoVideoController extends Controller
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
    public function store(Request $request, Course $course)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403,'You do not have access to carry out this request');
        }

        $request->validate([
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'
        ]);


        $course->update([
            'video_path' => request()->file('video')->store('promovideo', 'public')
        ]);
 
        $ffmpeg = FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open();
        $video
            ->filters()
            ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
            ->synchronize();
        $video
            ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
            ->save('frame.jpg');

        return response($course->video_path, 204);
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
