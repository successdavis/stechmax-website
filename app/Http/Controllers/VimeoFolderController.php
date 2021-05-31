<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Vimeo\Laravel\VimeoManager;

class VimeoFolderController extends Controller
{
    protected $vimeo;

    public function __construct(VimeoManager $vimeo)
    {
        $this->vimeo = $vimeo;
    }

    public function coursefolder(Course $course)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403,'You do not have access to carry out this request');
        }

        if ($course->published !== true) {
            return response(['message' => 'Please Complete setup and publish course first'], 422);
        }

        $request = $this->vimeo->request('/me/projects', 
            [
                'name'                      => $course->title
            ], 
        'POST');


        if ($request['status'] === 201) {

            $folderUri = explode('/', $request['body']['uri']);
            $folderId = $folderUri[4];

            $course->update([
                'vimeoFolderId' => $folderId
            ]);

            return $folderId;
        }

        return response(['message' => 'Technical Error Trying to create a folder'], 400);

    }
}
