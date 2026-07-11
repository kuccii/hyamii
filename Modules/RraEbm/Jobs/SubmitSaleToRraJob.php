<?php

namespace Modules\RraEbm\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Services\RraSaleSubmissionService;

class SubmitSaleToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public function __construct(
        public int $orderId
    ) {}

    public function backoff(): array
    {
        return config('rraebm.queue.backoff', [60, 300, 900, 3600, 14400]);
    }

    public function handle(RraSaleSubmissionService $submissionService): void
    {
        $order = Order::find($this->orderId);

        if (!$order) {
            Log::warning('RRA EBM: Order not found for submission', ['order_id' => $this->orderId]);
            return;
        }

        $submissionService->submitOrder($order);
    }

    public function failed(\Throwable $e): void
    {
        $order = Order::find($this->orderId);

        if ($order) {
            $order->update([
                'rra_ebm_queued' => false,
                'rra_ebm_error' => "Max attempts reached: {$e->getMessage()}",
            ]);
        }

        Log::error('RRA EBM submission failed after all retries', [
            'order_id' => $this->orderId,
            'error' => $e->getMessage(),
        ]);
    }
}
