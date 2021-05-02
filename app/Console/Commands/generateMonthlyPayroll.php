<?php

namespace App\Console\Commands;

use App\Payroll;
use Illuminate\Console\Command;

class generateMonthlyPayroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stechmax:generate-payroll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Employers payroll';

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
        if (Payroll::generatePayroll()) {
            $this->info('Payroll Generated Successfully');
        }
    }
}
