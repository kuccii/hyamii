<?php

namespace Modules\RraEbm\Services;

use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Entities\RraEbmStockItem;

class RraStockSyncService
{
    public function __construct(
        protected RraEbmService $ebmService,
        protected RraProductSyncService $productSyncService
    ) {}

    public function syncStock(RraEbmSetting $setting, MenuItem $menuItem, int $quantityChange): bool
    {
        if (!$setting->enabled || !$setting->isInitialized()) {
            return false;
        }

        $stockItem = RraEbmStockItem::updateOrCreate(
            [
                'branch_id' => $setting->branch_id,
                'menu_item_id' => $menuItem->id,
            ],
            [
                'quantity' => DB::raw("quantity + {$quantityChange}"),
            ]
        );

        $stockItem->refresh();

        if ($stockItem->quantity < 0) {
            $stockItem->update(['quantity' => 0]);
            $stockItem->refresh();
        }

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'itemCd' => $this->productSyncService->generateItemCode($setting, [
                'id' => $menuItem->id,
                'name' => $menuItem->item_name,
                'price' => $menuItem->price ?? 0,
            ]),
            'qty' => $stockItem->quantity,
            'unit' => 'EA',
            'date' => now()->format('Ymd'),
            'regrId' => config('rraebm.regr_id', 'Hyamii'),
            'regrNm' => config('rraebm.regr_nm', 'Hyamii'),
        ];

        $endpoint = config('rraebm.endpoints.save_stock_items', '/stock/saveStockItems');

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                $stockItem->update(['last_synced_at' => now()]);

                Log::info('RRA EBM: stock synced', [
                    'item_cd' => $payload['itemCd'],
                    'quantity' => $stockItem->quantity,
                ]);

                return true;
            }

            $error = $this->ebmService->getErrorMessage($response);
            Log::error('RRA EBM: stock sync failed', [
                'item_cd' => $payload['itemCd'],
                'error' => $error,
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('RRA EBM: stock sync exception', [
                'item_cd' => $payload['itemCd'],
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function deductStockOnSale(RraEbmSetting $setting, $orderItems): void
    {
        foreach ($orderItems as $orderItem) {
            $menuItem = $orderItem->menuItem;
            if (!$menuItem) {
                continue;
            }

            $this->syncStock($setting, $menuItem, -$orderItem->quantity);
        }
    }

    public function restoreStockOnCancellation(RraEbmSetting $setting, $orderItems): void
    {
        foreach ($orderItems as $orderItem) {
            $menuItem = $orderItem->menuItem;
            if (!$menuItem) {
                continue;
            }

            $this->syncStock($setting, $menuItem, $orderItem->quantity);
        }
    }

    public function getStockLevels(RraEbmSetting $setting): \Illuminate\Support\Collection
    {
        return RraEbmStockItem::where('branch_id', $setting->branch_id)
            ->with('menuItem')
            ->get();
    }
}
