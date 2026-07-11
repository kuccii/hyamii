<?php

namespace Modules\RraEbm\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraEodService;

class EodFilingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public int $branchId,
        public string $filingDate
    ) {}

    public function backoff(): array
    {
        return [120, 600, 1800];
    }

    public function handle(RraEodService $eodService): void
    {
        $setting = RraEbmSetting::where('branch_id', $this->branchId)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            Log::info('RRA EBM: EOD skipped - not configured', ['branch_id' => $this->branchId]);
            return;
        }

        $result = $eodService->fileDailySales($setting, $this->filingDate);

        if ($result['success']) {
            Log::info('RRA EBM: EOD filing completed', [
                'branch_id' => $this->branchId,
                'date' => $this->filingDate,
            ]);
        } else {
            Log::error('RRA EBM: EOD filing failed', [
                'branch_id' => $this->branchId,
                'date' => $this->filingDate,
                'error' => $result['error'],
            ]);
        }
    }

    public function failed(\Throwable $e): void
    {
        Log::error('RRA EBM EOD filing failed after all retries', [
            'branch_id' => $this->branchId,
            'date' => $this->filingDate,
            'error' => $e->getMessage(),
        ]);
    }
}
