<?php

namespace App;

use App\Notifications\NewMessage;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public static function addMessage(array $array)
    {
        $message = new self();
        $message->fullname   = $array['fullname'];
        $message->message   = $array['message'];
        $message->phone     = $array['phone'];
        $message->email     = $array['email'];

        $message->save();


        User::where('admin', true)->get()
            ->each
            ->notify(new NewMessage($message));

        return $message;
    }

}
