<?php

namespace Modules\RraEbm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\OrderItem;
use App\Models\Refund;

class RraEbmRefundItem extends Model
{
    protected $table = 'rra_ebm_refund_items';

    protected $guarded = ['id'];

    protected $casts = [
        'quantity' => 'integer',
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
    ];

    public function refund(): BelongsTo
    {
        return $this->belongsTo(Refund::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }
}
