<?php

namespace App\Console\Commands;

use App\Services\ApptikaService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LoadTopAppHistory extends Command
{
    protected $signature = 'apptika:load_top_app_history
                            {--date_from= : Start date (YYYY-MM-DD, default: 1 day ago)}
                            {--days=1 : Number of days to load (default: 1)}';

    protected $description = 'Loads history of top apps from API';

    public function __construct(private readonly ApptikaService $apptikaService)
    {
        parent::__construct();
    }

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
            : now()->startOfDay()->subDays($days);
        $dateTo = $dateFrom->copy()->addDays($days);

        try {
            $this->info("Processing date range: $dateFrom to $dateTo");
            $loaded = $this->apptikaService->loadTopAppHistory($dateFrom, $dateTo);
            $this->info("$loaded stats successfully loaded!");
        } catch (\Throwable $e) {
            $this->error("Cannot load data. Error: '{$e->getMessage()}'");
        }
    }
}
