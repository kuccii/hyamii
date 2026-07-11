<?php

namespace Modules\RraEbm\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Jobs\EodFilingJob;

class RraEodFilingCommand extends Command
{
    protected $signature = 'rra-ebm:eod-filing {--date= : Filing date (Y-m-d). Defaults to yesterday.} {--branch= : Branch ID. Process all branches if omitted.}';
    protected $description = 'File end-of-day sales report with RRA EBM';

    public function handle(): int
    {
        $date = $this->option('date') ?? Carbon::yesterday()->format('Y-m-d');
        $branchId = $this->option('branch');

        $settings = RraEbmSetting::where('enabled', true)
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->get();

        if ($settings->isEmpty()) {
            $this->warn('No enabled RRA EBM settings found.');
            return Command::SUCCESS;
        }

        $this->info("Filing EOD for {$date}...");

        foreach ($settings as $setting) {
            $branchName = $setting->branch ? $setting->branch->name : 'Unknown';
            $this->line("  Branch {$setting->branch_id}: {$branchName}");

            EodFilingJob::dispatch($setting->branch_id, $date)
                ->onConnection(config('rraebm.queue.connection', 'sync'));

            $this->info("    ✓ Queued");
        }

        $this->info("Done. {$settings->count()} branch(es) queued for EOD filing.");
        return Command::SUCCESS;
    }
}
