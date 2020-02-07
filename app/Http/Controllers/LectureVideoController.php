<?php

namespace App\Http\Controllers;

use App\Video;
use App\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LectureVideoController extends Controller
{
    public function store(Request $request, Lecture $lecture)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'
        ]);

        $video = Video::create([
            'lecture_id'    => $lecture->id,
            'language'      => 'English',
            'url'           => request()->file('video')->storeAs('lecturevideo', $lecture->slug, 'public')
        ]);

        // $ffprobe = FFMpeg\FFProbe::create();

        // $duration = $ffprobe
        //     ->format($course->video_path) // extracts file informations
        //     ->get('duration');             // returns the duration property

        // dd($duration);

        return response($lecture->getVideoUrl(), 204);
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
