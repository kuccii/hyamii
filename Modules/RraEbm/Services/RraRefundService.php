<?php

namespace Modules\RraEbm\Services;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmRefundItem;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraRefundService
{
    public function __construct(
        protected RraEbmService $ebmService,
        protected RraProductSyncService $productSyncService
    ) {}

    public function submitCreditNote(Refund $refund): bool
    {
        $order = $refund->order;

        if (!$order) {
            Log::warning('RRA EBM: Refund has no associated order', ['refund_id' => $refund->id]);
            return false;
        }

        $setting = RraEbmSetting::where('branch_id', $order->branch_id)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            Log::info('RRA EBM: cannot submit credit note - not configured', ['refund_id' => $refund->id]);
            return false;
        }

        if (!$order->rra_ebm_submitted || $order->rra_ebm_cancelled) {
            Log::info('RRA EBM: order not submitted/cancelled, skip credit note', ['refund_id' => $refund->id]);
            return false;
        }

        $receiptSignature = $order->rraEbmReceiptSignature;

        if (!$receiptSignature) {
            Log::error('RRA EBM: no receipt signature for refund order', ['refund_id' => $refund->id, 'order_id' => $order->id]);
            return false;
        }

        $regrId = config('rraebm.regr_id', 'Hyamii');
        $regrNm = config('rraebm.regr_nm', 'Hyamii');

        $refundItems = RraEbmRefundItem::where('refund_id', $refund->id)->get();

        $itemList = [];
        foreach ($refundItems as $index => $refundItem) {
            $orderItem = $refundItem->orderItem;
            if (!$orderItem) {
                continue;
            }

            $itemList[] = [
                'itemSeq' => $index + 1,
                'itemCd' => $this->productSyncService->generateItemCode($setting, [
                    'id' => $orderItem->menu_item_id,
                    'name' => $orderItem->menuItem?->item_name ?? "Item #{$orderItem->menu_item_id}",
                    'price' => $orderItem->price,
                ]),
                'itemNm' => $orderItem->menuItem?->item_name ?? "Item #{$orderItem->menu_item_id}",
                'qty' => $refundItem->quantity,
                'prc' => round($orderItem->price, 2),
                'splyAmt' => round($refundItem->amount, 2),
                'taxblAmt' => round($refundItem->amount, 2),
                'taxTyCd' => $refundItem->tax_code,
                'taxAmt' => round($refundItem->tax_amount, 2),
            ];
        }

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'orgNr' => 0,
            'rcptNo' => (int) $receiptSignature->receipt_number,
            'cnRsnCd' => $this->mapRefundReason($refund),
            'cnRmk' => "Refund for Order #{$order->formatted_order_number}: " . ($refund->refund_reason ? $refund->refund_reason->reason : 'No reason'),
            'refundAmt' => round($refund->amount, 2),
            'regrId' => $regrId,
            'regrNm' => $regrNm,
        ];

        if (!empty($itemList)) {
            $payload['itemList'] = $itemList;
        }

        $endpoint = config('rraebm.endpoints.cancel_sale', '/trnsSales/cancelSales');

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                Log::info('RRA EBM: credit note submitted', [
                    'refund_id' => $refund->id,
                    'order_id' => $order->id,
                    'amount' => $refund->amount,
                    'items' => count($itemList),
                ]);

                return true;
            }

            $error = $this->ebmService->getErrorMessage($response);
            Log::error('RRA EBM: credit note failed', [
                'refund_id' => $refund->id,
                'error' => $error,
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('RRA EBM: credit note exception', [
                'refund_id' => $refund->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function createRefundItems(Refund $refund, array $items): void
    {
        foreach ($items as $item) {
            RraEbmRefundItem::create([
                'refund_id' => $refund->id,
                'order_item_id' => $item['order_item_id'],
                'quantity' => $item['quantity'] ?? 1,
                'amount' => $item['amount'] ?? 0,
                'tax_amount' => $item['tax_amount'] ?? 0,
                'tax_code' => $item['tax_code'] ?? 'B',
            ]);
        }
    }

    private function mapRefundReason(Refund $refund): string
    {
        $reasonCodeMap = [
            'full' => '03',
            'partial' => '02',
            'waste' => '03',
        ];

        return $reasonCodeMap[$refund->refund_type] ?? '09';
    }
}
