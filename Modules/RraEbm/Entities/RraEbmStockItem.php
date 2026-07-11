<?php

namespace Modules\RraEbm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Branch;
use App\Models\MenuItem;

class RraEbmStockItem extends Model
{
    protected $table = 'rra_ebm_stock_items';

    protected $guarded = ['id'];

    protected $casts = [
        'quantity' => 'integer',
        'last_synced_at' => 'datetime',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
