<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show()
    {
        $search = request('q');

        $threads = Thread::where('title', 'LIKE', '%' . $search . '%')->paginate(25);
        if (request()->expectsJson()) {
            return $threads;
        }

        return view('forum.index', [
            'threads' => $threads
            // 'trending' => $trending->get()
        ]);
    }
}
