<?php

namespace App\Console\Commands;

use App\Services\UrlService;
use Illuminate\Console\Command;

class UrlClearCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'We search for URLS that have not been updated in the last 30 days.';

    public function __construct(public readonly UrlService $urlService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Command Initiated.');
        $counter = $this->urlService->clearUrlsUpdate();
        $this->warn($counter . ' Urls Cleared.');
        $this->info('Command Terminated.');
    }
}
