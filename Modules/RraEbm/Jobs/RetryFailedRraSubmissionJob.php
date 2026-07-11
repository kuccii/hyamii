<?php

namespace Modules\RraEbm\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RetryFailedRraSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public function __construct(
        public int $orderId
    ) {}

    public function handle(): void
    {
        $order = Order::find($this->orderId);

        if (!$order) {
            Log::warning('RRA EBM retry: Order not found', ['order_id' => $this->orderId]);
            return;
        }

        if ($order->rra_ebm_submitted) {
            Log::info('RRA EBM retry: Order already submitted', ['order_id' => $this->orderId]);
            return;
        }

        $order->update([
            'rra_ebm_attempts' => 0,
            'rra_ebm_error' => null,
            'rra_ebm_queued' => true,
        ]);

        SubmitSaleToRraJob::dispatch($this->orderId);

        Log::info('RRA EBM retry dispatched', ['order_id' => $this->orderId]);
    }
}
