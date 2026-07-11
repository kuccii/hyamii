<?php

namespace App\Observers;

use App\Models\MenuItem;

class MenuItemObserver
{

    public function creating(MenuItem $menuItem)
    {
        if (branch()) {
            $menuItem->branch_id = branch()->id;
        }
    }

    public function created(MenuItem $menuItem): void
    {
        $this->syncToRraEbm($menuItem);
    }

    public function updated(MenuItem $menuItem): void
    {
        if ($menuItem->wasChanged(['item_name', 'price', 'is_available'])) {
            $this->syncToRraEbm($menuItem);
        }
    }

    private function syncToRraEbm(MenuItem $menuItem): void
    {
        if (!\Nwidart\Modules\Facades\Module::has('RraEbm') || !\Nwidart\Modules\Facades\Module::isEnabled('RraEbm')) {
            return;
        }

        $branchId = $menuItem->branch_id ?? branch()?->id;

        if (!$branchId) {
            return;
        }

        \Modules\RraEbm\Jobs\SyncProductToRraJob::dispatch($menuItem->id, $branchId);
    }

}
