<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Lecture;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Vimeo\Laravel\VimeoManager;



class LectureVideoController extends Controller
{
    protected $vimeo;

    public function __construct(VimeoManager $vimeo)
    {
        $this->vimeo = $vimeo;
    }

    public function store(StoreVideoRequest $request, Lecture $lecture)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403,'You do not have access to carry out this request');
        }

        $request->validate([
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'
        ]);

        $ext = $request->video->getClientOriginalExtension();
        $name = $lecture->slug .'.'.$ext;

        $videoUri = $this->vimeo->upload(request()->file('video'), [
                "name"  => $name,
                "privacy" => [ 
                    "view" => "nobody",
                    "comments" => "nobody",
                    "embed" => "whitelist",
                ],
            ]);

        $videoUriArray = explode('/', $videoUri);

        $videoId = $videoUriArray[2];

        $lecture->update([
            'video_path' => $videoId
        ]);

        $this->moveVideoToCourseFolder($lecture->section->course->vimeoFolderId, $videoId);

        $this->whitelistVideo($videoId);

        return response(['message' => 'Lecture Upload Successful'], 204, []);
    }

    public function whitelistVideo($videoId)
    {
        $url = '/videos/'. $videoId . 
            '/privacy/domains/' . env('SITE_URL', null);

        return $result = $this->vimeo->request(
            $url,[],'PUT'
        );
    }

    public function moveVideoToCourseFolder($folderId, $videoId)
    {
        return $result = $this->vimeo->request(
            '/me/projects/'
            .$folderId
            .'/videos/'. $videoId,[], 'PUT'
        );
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
