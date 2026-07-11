<?php

namespace Modules\RraEbm\Jobs;

use App\Models\MenuItem;
use App\Models\Branch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraProductSyncService;

class SyncProductToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public int $menuItemId,
        public int $branchId
    ) {}

    public function handle(RraProductSyncService $syncService): void
    {
        $setting = RraEbmSetting::where('branch_id', $this->branchId)->first();

        if (!$setting || !$setting->enabled || !$setting->auto_sync_products) {
            return;
        }

        $menuItem = MenuItem::find($this->menuItemId);

        if (!$menuItem) {
            Log::warning('RRA EBM: Menu item not found', ['menu_item_id' => $this->menuItemId]);
            return;
        }

        $taxPercent = 0;
        if ($menuItem->taxes->isNotEmpty()) {
            $taxPercent = (float) $menuItem->taxes->first()->tax_percent;
        }

        $productData = [
            'id' => $menuItem->id,
            'name' => $menuItem->item_name,
            'standard_name' => $menuItem->item_name,
            'price' => $menuItem->price,
            'tax_percent' => $taxPercent,
            'barcode' => $menuItem->id,
            'item_cd' => $syncService->generateItemCode($setting, [
                'id' => $menuItem->id,
                'name' => $menuItem->item_name,
                'price' => $menuItem->price,
            ]),
        ];

        $syncService->syncProduct($setting, $productData);
    }
}
