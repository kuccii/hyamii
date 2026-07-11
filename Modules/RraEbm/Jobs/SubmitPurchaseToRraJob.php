<?php

namespace Modules\RraEbm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmPurchase;
use Modules\RraEbm\Services\RraPurchaseService;

class SubmitPurchaseToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public int $purchaseId
    ) {}

    public function backoff(): array
    {
        return [60, 300, 900];
    }

    public function handle(RraPurchaseService $purchaseService): void
    {
        $purchase = RraEbmPurchase::find($this->purchaseId);

        if (!$purchase) {
            Log::warning('RRA EBM: Purchase not found', ['purchase_id' => $this->purchaseId]);
            return;
        }

        $purchaseService->submitPurchase($purchase);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('RRA EBM purchase submission failed', [
            'purchase_id' => $this->purchaseId,
            'error' => $e->getMessage(),
        ]);
    }
}
