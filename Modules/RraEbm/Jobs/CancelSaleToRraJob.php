<?php

namespace Modules\RraEbm\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Services\RraCancellationService;

class CancelSaleToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public int $orderId,
        public string $reasonCode = 'order_cancelled',
        public string $reason = ''
    ) {}

    public function backoff(): array
    {
        return [60, 300, 900];
    }

    public function handle(RraCancellationService $cancellationService): void
    {
        $order = Order::find($this->orderId);

        if (!$order) {
            Log::warning('RRA EBM: Order not found for cancellation', ['order_id' => $this->orderId]);
            return;
        }

        $cancellationService->cancelOrder($order, $this->reasonCode, $this->reason);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('RRA EBM cancellation failed after all retries', [
            'order_id' => $this->orderId,
            'error' => $e->getMessage(),
        ]);
    }
}
