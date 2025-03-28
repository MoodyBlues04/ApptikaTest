<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class LoadTopAppHistory extends Command
{
    protected $signature = 'apptika:load_top_app_history
                            {--date_from= : Start date (YYYY-MM-DD, default: 1 day ago)}
                            {--D|days=1 : Number of days to load (default: 1)}';

    protected $description = 'Loads history of top apps from API';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $days = $this->option('days');
        if ($days <= 0) {
            $this->error('days must be positive');
            return;
        }

        $dateFrom = $this->option('date_from')
            ? Carbon::parse($this->option('date_from'))->startOfDay()
            : now()->subDays($days);
        $dateTo = $dateFrom->addDays($days);

        $progress = $this->output->createProgressBar($days + 1);

        $this->info("Processing {$days} days...");
        $progress->start();
        $progress->advance();
    }
}
