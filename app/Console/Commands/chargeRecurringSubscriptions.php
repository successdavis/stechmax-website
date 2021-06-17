<?php

namespace App\Console\Commands;

use App\Subscription;
use Illuminate\Console\Command;

class chargeRecurringSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stechmax:charge-recurring-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge subscription that has recurring set to true';

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
        if (Subscription::chargeRecurringSubscriptions()) {
            $this->info('Charge operation has been done');
        }
    }
}
