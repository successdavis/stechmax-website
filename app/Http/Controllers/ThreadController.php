<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::latest()->get();
        return view('forum.index', compact('threads'));
    }

    public function show(Thread $thread)
    {
        return view('forum.show', compact('thread'));
    }
}
