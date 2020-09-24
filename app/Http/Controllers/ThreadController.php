<?php

namespace App\Http\Controllers;
use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {

        $threads = $this->getThreads($channel, $filters);

        // return $threads;

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('forum.index', compact('threads'));
    }

   public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id'
        ]);


        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'channel_id' => request('channel_id'),
            'body' => request('body'),
        ]);
        auth()->user()->awardExperience(10,'Post New Thread');

        if (request()->wantsJson()) {
            return response($thread->path(), 201);
        }

        return redirect($thread->path())
            ->with('flash', 'Your Question has been published!');
    }

    public function show($channelId, Thread $thread)
    {
        $thread->increment('visits');
        return view('forum.show', compact('thread'));
    }

    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update(request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree'
        ]));

        return $thread;
    }

     public function destroy($channel, Thread $thread)
    {
        if (!auth()->user()->isAdmin()) {
            return back()->with('flash', 'Please contact an administrator');
        }
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads');
    }


    public function getThreads($channel, $filters)
    {
        $threads = Thread::latest()->filter($filters);
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads = $threads->paginate(25);
    }
}
