<?php

namespace Modules\RraEbm\Services;

use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraProductSyncService
{
    public function __construct(
        protected RraEbmService $ebmService
    ) {}

    public function syncProduct(RraEbmSetting $setting, array $productData): bool
    {
        if (!$setting->enabled || !$setting->isInitialized()) {
            return false;
        }

        $taxCode = $this->resolveTaxCode($productData['tax_percent'] ?? 0);

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'itemCd' => $productData['item_cd'] ?? $this->generateItemCode($setting, $productData),
            'itemClsCd' => $productData['item_cls_cd'] ?? 'S',
            'itemTyCd' => $productData['item_ty_cd'] ?? 'S',
            'itemNm' => $productData['name'],
            'itemStdNm' => $productData['standard_name'] ?? $productData['name'],
            'orgnNatCd' => $productData['origin_country_code'] ?? 'RW',
            'pkgUnitCd' => $productData['pkg_unit_cd'] ?? 'EA',
            'qtyUnitCd' => $productData['qty_unit_cd'] ?? 'EA',
            'taxTyCd' => $taxCode,
            'bcd' => $productData['barcode'] ?? '',
            'dftPrc' => $productData['price'],
            'useYn' => 'Y',
            'regrId' => 'Hyamii',
            'regrNm' => 'Hyamii',
            'modrId' => 'Hyamii',
            'modrNm' => 'Hyamii',
        ];

        $endpoint = config('rraebm.endpoints.save_item', '/items/saveItems');
        $response = $this->ebmService->post($setting, $endpoint, $payload);

        if ($this->ebmService->isSuccessful($response)) {
            Log::info('Product synced to RRA EBM', [
                'item_cd' => $payload['itemCd'],
                'name' => $payload['itemNm'],
            ]);
            return true;
        }

        Log::error('Failed to sync product to RRA EBM', [
            'item_cd' => $payload['itemCd'],
            'error' => $this->ebmService->getErrorMessage($response),
        ]);

        return false;
    }

    public function resolveTaxCode(float $taxPercent): string
    {
        $taxCodes = config('rraebm.tax_codes', [0 => 'A', 18 => 'B']);

        return $taxCodes[(int) $taxPercent] ?? config('rraebm.default_tax_code', 'A');
    }

    public function generateItemCode(RraEbmSetting $setting, array $productData): string
    {
        $countryCode = $productData['origin_country_code'] ?? 'RW';
        $typeCode = $productData['item_ty_cd'] ?? 'S';
        $pkgCode = $productData['pkg_unit_cd'] ?? 'EA';
        $qtyCode = $productData['qty_unit_cd'] ?? 'EA';
        $itemId = str_pad((string) ($productData['id'] ?? 1), 7, '0', STR_PAD_LEFT);

        return $countryCode . $typeCode . $pkgCode . $qtyCode . $itemId;
    }
}
