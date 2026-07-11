<?php

namespace Modules\RraEbm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Branch;

class RraEbmSetting extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'enabled' => 'boolean',
        'auto_sync_products' => 'boolean',
        'submit_on_pos_complete' => 'boolean',
        'submit_on_online_order' => 'boolean',
        'submit_on_kiosk' => 'boolean',
        'last_initialized_at' => 'datetime',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function shouldSubmitFor(?string $orderType): bool
    {
        if (!$this->enabled) {
            return false;
        }

        return match ($orderType) {
            'pos', 'dine-in' => $this->submit_on_pos_complete,
            'shop', 'delivery', 'pickup', 'takeaway' => $this->submit_on_online_order,
            'kiosk' => $this->submit_on_kiosk,
            default => $this->submit_on_pos_complete,
        };
    }

    public function isInitialized(): bool
    {
        return $this->last_initialized_at !== null
            && $this->tin_number
            && $this->branch_id_rra
            && $this->server_url;
    }
}
