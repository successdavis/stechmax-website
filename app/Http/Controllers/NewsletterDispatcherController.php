<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterFromStechmax;
use App\Newsletter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;



class NewsletterDispatcherController extends Controller
{
    private $sendTo;
    private $newsletter;

    public function __construct(Request $request) {
        $request->validate([
            'tags'          => 'required|array',
            'sendTo'        => 'required|string',
            'body'          => 'required|string',
            'category'      => 'required|string',
            'subject'       => 'required|string',
        ]);

        $this->sendTo = $request->sendTo;
    }

    public function store(Request $request)
    {
        $sendTo = $request->sendTo;

        $newsletter = new Newsletter();

        $newsletter->type = $request->sendTo;
        $newsletter->body = $request->body;
        $newsletter->title = $request->subject;
        $newsletter->purpose = $request->category;
        $newsletter->save();

        $this->newsletter = $newsletter;

        if (method_exists($this, $this->sendTo)) {
            $this->$sendTo();
        }

        return true;

    }

    public function user() {

        $users = User::find(
            array_map(function($tag) {
                return $tag['id'];
            },  request()->tags)
        );

        foreach($users as $user) {
            $newsletter = $user->news()->create([
                'newsletter_id' => $this->newsletter->id,
                'sent_at'       => Carbon::now(),
            ]);
            if (
                Mail::to($user)->send(new NewsletterFromStechmax($user->f_name, request()->body, request()->subject))
            ) {
                $newsletter->status = true;
                $newsletter->save();
            }
        }

        return true;

    }
}
