<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\Mail\NewsletterFromStechmax;
use App\Newsletter;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class NewsletterDispatcherController extends Controller
{
    private $sendTo;
    private $newsletter;
    private $name;

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

        return $this->sendMail($users);

    }

    public function client() {
        $clients = Client::find(
            array_map(function($tag) {
                return $tag['id'];
            },  request()->tags)
        );

        $this->name = 'fullname';
        
        return $this->sendMail($clients);
    }

    public function employee() {
        $employees = Employee::find(
            array_map(function($tag) {
                return $tag['id'];
            },  request()->tags)
        )->map(function($emp) {
            return $emp->user;
        });

        return $this->sendMail($employees);
    }

    public function tag() {

        $syncs = Tag::find(
            array_map(function($tag) {
                return $tag['id'];
            },  request()->tags)
        )->map(function($tag){ return $tag->clients()->get();})->flatten();

        $clients = $syncs->map(function($s){ return $s->taggable()->whereNotNull('email')->get();})->unique();

        $this->name = 'fullname';

        if ($clients->isNotEmpty()) {
            return $this->sendMail($clients->flatten(), 'fullname');
        }
    }

    public function sendMail($targets) {
        foreach($targets as $user) {
            $newsletter = $user->news()->create([
                'newsletter_id' => $this->newsletter->id,
                'sent_at'       => Carbon::now(),
            ]);

            $name = $this->name;

            Mail::to($user)
                ->cc('support@stechmax.com')
                ->send(new NewsletterFromStechmax($this->name ? $user->$name : $user->f_name, request()->body, request()->subject));

            $newsletter->status = true;
            $newsletter->save();

            return true;
        }    
    }
}
