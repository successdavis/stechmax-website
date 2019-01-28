<?php

namespace App\Console\Commands;

use App\Subscription;
use Illuminate\Console\Command;

class deactivateSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:subscription {subscription?
    }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and Deactivate due subscriptions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription)
    {
        parent::__construct();
        $this->subscription = $subscription;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($subscription = Subscription::find($this->argument('subscription'))) {
            $subscription->deactivate();
        }

        if (Subscription::deactivateDueSubscriptions()) {
            $this->info('Due Subscription successfully deactivated');
        }
    }
}
