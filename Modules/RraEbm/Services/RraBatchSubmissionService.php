<?php

namespace Modules\RraEbm\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmInvoiceSequence;
use Modules\RraEbm\Entities\RraEbmReceiptSignature;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraBatchSubmissionService
{
    public function __construct(
        protected RraEbmService $ebmService,
        protected RraSaleSubmissionService $submissionService
    ) {}

    public function submitBatch(RraEbmSetting $setting, array $orderIds): array
    {
        $orders = Order::with(['items.menuItem', 'items.modifierOptions', 'taxes.tax'])
            ->whereIn('id', $orderIds)
            ->where('branch_id', $setting->branch_id)
            ->where('status', 'paid')
            ->where('rra_ebm_submitted', false)
            ->get();

        if ($orders->isEmpty()) {
            return ['success' => true, 'submitted' => 0, 'failed' => 0];
        }

        $submitted = 0;
        $failed = 0;

        foreach ($orders as $order) {
            try {
                $result = $this->submissionService->submitOrder($order);
                if ($result) {
                    $submitted++;
                } else {
                    $failed++;
                }
            } catch (\Exception $e) {
                $failed++;
                Log::error('RRA EBM: batch submission failed for order', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return [
            'success' => $failed === 0,
            'submitted' => $submitted,
            'failed' => $failed,
            'total' => $orders->count(),
        ];
    }

    public function getPendingOrders(RraEbmSetting $setting, string $startDate, string $endDate): \Illuminate\Support\Collection
    {
        return Order::where('branch_id', $setting->branch_id)
            ->where('status', 'paid')
            ->where('rra_ebm_submitted', false)
            ->whereBetween('date_time', [$startDate, $endDate])
            ->orderBy('date_time')
            ->get();
    }

    public function submitAllPending(RraEbmSetting $setting, string $startDate, string $endDate): array
    {
        $pendingOrders = $this->getPendingOrders($setting, $startDate, $endDate);

        if ($pendingOrders->isEmpty()) {
            return ['success' => true, 'submitted' => 0, 'failed' => 0];
        }

        $orderIds = $pendingOrders->pluck('id')->toArray();

        return $this->submitBatch($setting, $orderIds);
    }
}
