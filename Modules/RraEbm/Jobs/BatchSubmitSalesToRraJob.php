<?php

namespace Modules\RraEbm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraBatchSubmissionService;

class BatchSubmitSalesToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public function __construct(
        public int $branchId,
        public string $startDate,
        public string $endDate
    ) {}

    public function backoff(): array
    {
        return [300, 1800];
    }

    public function handle(RraBatchSubmissionService $batchService): void
    {
        $setting = RraEbmSetting::where('branch_id', $this->branchId)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            Log::info('RRA EBM: batch submission skipped - not configured', ['branch_id' => $this->branchId]);
            return;
        }

        $result = $batchService->submitAllPending($setting, $this->startDate, $this->endDate);

        Log::info('RRA EBM: batch submission completed', [
            'branch_id' => $this->branchId,
            'date_range' => "{$this->startDate} to {$this->endDate}",
            'submitted' => $result['submitted'],
            'failed' => $result['failed'],
        ]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('RRA EBM batch submission failed', [
            'branch_id' => $this->branchId,
            'error' => $e->getMessage(),
        ]);
    }
}
