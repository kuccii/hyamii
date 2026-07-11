<?php

namespace Modules\RraEbm\Jobs;

use App\Models\Refund;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Services\RraRefundService;

class SubmitCreditNoteToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public int $refundId
    ) {}

    public function backoff(): array
    {
        return [60, 300, 900];
    }

    public function handle(RraRefundService $refundService): void
    {
        $refund = Refund::find($this->refundId);

        if (!$refund) {
            Log::warning('RRA EBM: Refund not found for credit note', ['refund_id' => $this->refundId]);
            return;
        }

        $refundService->submitCreditNote($refund);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('RRA EBM credit note failed after all retries', [
            'refund_id' => $this->refundId,
            'error' => $e->getMessage(),
        ]);
    }
}
