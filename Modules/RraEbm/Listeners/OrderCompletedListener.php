<?php

namespace Modules\RraEbm\Listeners;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Jobs\SubmitSaleToRraJob;

class OrderCompletedListener
{
    public function handle($event): void
    {
        $order = $event->order ?? null;

        if (!$order || !($order instanceof Order)) {
            return;
        }

        if (!\Nwidart\Modules\Facades\Module::has('RraEbm') || !\Nwidart\Modules\Facades\Module::isEnabled('RraEbm')) {
            return;
        }

        $rraSetting = RraEbmSetting::where('branch_id', $order->branch_id)->first();

        if (!$rraSetting || !$rraSetting->enabled) {
            return;
        }

        if (!$rraSetting->shouldSubmitFor($order->order_type)) {
            return;
        }

        if ($order->rra_ebm_submitted) {
            return;
        }

        $order->update(['rra_ebm_queued' => true]);

        SubmitSaleToRraJob::dispatch($order->id)
            ->onConnection(config('rraebm.queue.connection', 'sync'));

        Log::info('RRA EBM submission queued for order', ['order_id' => $order->id]);
    }
}
