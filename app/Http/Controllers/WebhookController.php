<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $payload;
    public function __construct()
    {
        if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER) ) 
        exit();

        // Retrieve the request's body
        $input = @file_get_contents("php://input");
        define('PAYSTACK_SECRET_KEY','SECRET_KEY');

        // validate event do all at once to avoid timing attack
        if($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))
          exit();

        http_response_code(200);

        // parse event (which is json string) as object
        // Do something - that will not take long - with $event
        // $this->payload = json_decode($input);
        $this->payload = request()->all();

    }

    public function handle()
    {
        if ($this->payload['event'] == 'subscription.disable') {
            $user = User::where('paystack_id', $this->payload['data']['customer']['customer_code'])->firstOrFail();

            $user->deactive();
        }
    }
}
