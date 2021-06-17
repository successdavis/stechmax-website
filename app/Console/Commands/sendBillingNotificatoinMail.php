<?php

namespace App\Console\Commands;

use App\Subscription;
use Illuminate\Console\Command;

class sendBillingNotificatoinMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stechmax:send-billing-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to Subscribers 6 days before billing them';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (Subscription::sendBillingNotificationMail()) {
            $this->info('Notification has been dispatched');
        }
    }
}
