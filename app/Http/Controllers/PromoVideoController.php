<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Vimeo\Laravel\VimeoManager;
use Vimeo\Vimeo;

class PromoVideoController extends Controller
{
    protected $vimeo;

    public function __construct(VimeoManager $vimeo)
    {
        $this->vimeo = $vimeo;
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

        $ext = $request->video->getClientOriginalExtension();
        $name = $course->slug .'.'.$ext;

        $course->update([
            'video_path' => $this->vimeo->upload(request()->file('video'), [
                'name' => $name,
                'privacy' => [
                    'view' => 'anybody'
                ],
            ])
        ]);
        
        return response($course->video_path, 204, []);
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
