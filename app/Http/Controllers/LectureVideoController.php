<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use App\Lecture;
use App\Video;
use FFMpeg\FFProbe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;


class LectureVideoController extends Controller
{
    public function store(StoreVideoRequest $request, Lecture $lecture)
    {
        $ext = $request->video->getClientOriginalExtension();
        $name = $lecture->slug.'.'.$ext;
        $path = $request->video->storeAs('lectures', $name, 's3');

        $lectureUpdate = $lecture->update([
            'disk'                  => 's3',
            'original_video_name'   => $request->video->getClientOriginalName(),
            'video_path'            => $path,
            'title'                 => $lecture->title,
        ]);
 
        ConvertVideoForStreaming::dispatch($lecture);
 
        return response(200);
    }

    public function update(Request $request, Lecture $lecture)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'
        ]);

        $lecture->video->delete();

        $video = Video::create([
            'lecture_id'    => $lecture->id,
            'language'      => 'English',
            'url'           => request()->file('video')->storeAs('lecturevideo', $lecture->slug, 'public')
        ]);

        return response($lecture->getVideoUrl(), 204);
    }

    public function destroy(Lecture $lecture)
    {
        $file = $lecture->slug. '.mp4';

        $lecture->video->delete();
    }

    public function playlist(Course $course)
    {
        return $course->sections()->get();
    }
}
