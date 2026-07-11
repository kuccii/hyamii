<?php

namespace Modules\RraEbm\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraCancellationService
{
    public function __construct(
        protected RraEbmService $ebmService
    ) {}

    public function cancelOrder(Order $order, string $reasonCode = 'order_cancelled', string $reason = ''): bool
    {
        $setting = RraEbmSetting::where('branch_id', $order->branch_id)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            Log::info('RRA EBM: cannot cancel - not configured', ['order_id' => $order->id]);
            return false;
        }

        if (!$order->rra_ebm_submitted) {
            Log::info('RRA EBM: order not submitted, skip cancel', ['order_id' => $order->id]);
            return false;
        }

        if ($order->rra_ebm_cancelled) {
            Log::info('RRA EBM: order already cancelled', ['order_id' => $order->id]);
            return true;
        }

        $receiptSignature = $order->rraEbmReceiptSignature;

        if (!$receiptSignature) {
            Log::error('RRA EBM: no receipt signature for submitted order', ['order_id' => $order->id]);
            return false;
        }

        $cancelReasonCodes = config('rraebm.cancel_reason_codes', []);
        $cnRsnCode = $cancelReasonCodes[$reasonCode] ?? $cancelReasonCodes['other'] ?? '09';

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'orgNr' => 0,
            'rcptNo' => (int) $receiptSignature->receipt_number,
            'cnRsnCd' => $cnRsnCode,
            'cnRmk' => $reason ?: "Order #{$order->formatted_order_number} cancelled",
        ];

        $endpoint = config('rraebm.endpoints.cancel_sale', '/trnsSales/cancelSales');

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                $order->update([
                    'rra_ebm_cancelled' => true,
                    'rra_ebm_cancelled_at' => now(),
                ]);

                Log::info('RRA EBM: order cancelled successfully', [
                    'order_id' => $order->id,
                    'receipt_number' => $receiptSignature->receipt_number,
                ]);

                return true;
            }

            $error = $this->ebmService->getErrorMessage($response);
            Log::error('RRA EBM: cancellation failed', [
                'order_id' => $order->id,
                'error' => $error,
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('RRA EBM: cancellation exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
