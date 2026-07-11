<?php

namespace Modules\RraEbm\Jobs;

use App\Models\MenuItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmSetting;
use Modules\RraEbm\Services\RraStockSyncService;

class SyncStockToRraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(
        public int $branchId,
        public int $menuItemId,
        public int $quantityChange
    ) {}

    public function backoff(): array
    {
        return [60, 300, 900];
    }

    public function handle(RraStockSyncService $stockSyncService): void
    {
        $setting = RraEbmSetting::where('branch_id', $this->branchId)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            return;
        }

        $menuItem = MenuItem::find($this->menuItemId);

        if (!$menuItem) {
            Log::warning('RRA EBM: Menu item not found for stock sync', ['menu_item_id' => $this->menuItemId]);
            return;
        }

        $stockSyncService->syncStock($setting, $menuItem, $this->quantityChange);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('RRA EBM stock sync failed', [
            'branch_id' => $this->branchId,
            'menu_item_id' => $this->menuItemId,
            'error' => $e->getMessage(),
        ]);
    }
}
