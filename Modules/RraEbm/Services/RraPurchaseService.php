<?php

namespace Modules\RraEbm\Services;

use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmPurchase;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraPurchaseService
{
    public function __construct(
        protected RraEbmService $ebmService,
        protected RraProductSyncService $productSyncService
    ) {}

    public function submitPurchase(RraEbmPurchase $purchase): bool
    {
        $setting = RraEbmSetting::where('branch_id', $purchase->branch_id)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            Log::info('RRA EBM: cannot submit purchase - not configured', ['purchase_id' => $purchase->id]);
            return false;
        }

        if ($purchase->submitted) {
            Log::info('RRA EBM: purchase already submitted', ['purchase_id' => $purchase->id]);
            return true;
        }

        $items = json_decode($purchase->items_json, true) ?? [];

        $itemList = [];
        foreach ($items as $index => $item) {
            $itemList[] = [
                'itemSeq' => $index + 1,
                'itemCd' => $item['item_cd'] ?? '',
                'itemNm' => $item['name'] ?? '',
                'qty' => $item['quantity'] ?? 1,
                'prc' => round($item['unit_price'] ?? 0, 2),
                'splyAmt' => round(($item['unit_price'] ?? 0) * ($item['quantity'] ?? 1), 2),
                'taxblAmt' => round(($item['unit_price'] ?? 0) * ($item['quantity'] ?? 1), 2),
                'taxTyCd' => $item['tax_code'] ?? 'B',
                'taxAmt' => round($item['tax_amount'] ?? 0, 2),
            ];
        }

        $regrId = config('rraebm.regr_id', 'Hyamii');
        $regrNm = config('rraebm.regr_nm', 'Hyamii');

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'supTin' => $purchase->supplier_tin ?? '',
            'supNm' => $purchase->supplier_name,
            'invcNo' => $purchase->invoice_number,
            'purchDt' => $purchase->purchase_date->format('Ymd'),
            'totItemCnt' => count($itemList),
            'totTaxblAmt' => round($purchase->total_amount - $purchase->tax_amount, 2),
            'totTaxAmt' => round($purchase->tax_amount, 2),
            'totAmt' => round($purchase->total_amount, 2),
            'regrId' => $regrId,
            'regrNm' => $regrNm,
            'modrId' => $regrId,
            'modrNm' => $regrNm,
            'itemList' => $itemList,
        ];

        $endpoint = config('rraebm.endpoints.save_purchases', '/trnsPurchase/savePurchases');

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                $purchase->update([
                    'submitted' => true,
                    'submitted_at' => now(),
                ]);

                Log::info('RRA EBM: purchase submitted', [
                    'purchase_id' => $purchase->id,
                    'invoice_number' => $purchase->invoice_number,
                ]);

                return true;
            }

            $error = $this->ebmService->getErrorMessage($response);
            $purchase->update(['error_message' => $error]);

            Log::error('RRA EBM: purchase submission failed', [
                'purchase_id' => $purchase->id,
                'error' => $error,
            ]);

            return false;
        } catch (\Exception $e) {
            $purchase->update(['error_message' => $e->getMessage()]);

            Log::error('RRA EBM: purchase submission exception', [
                'purchase_id' => $purchase->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
