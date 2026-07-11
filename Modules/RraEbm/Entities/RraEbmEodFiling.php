<?php

namespace Modules\RraEbm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Branch;

class RraEbmEodFiling extends Model
{
    protected $table = 'rra_ebm_eod_filings';

    protected $guarded = ['id'];

    protected $casts = [
        'total_sales_amount' => 'decimal:2',
        'total_tax_amount' => 'decimal:2',
        'filed_at' => 'datetime',
        'closed_at' => 'datetime',
        'day_closed' => 'boolean',
        'rra_response' => 'array',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function isFiled(): bool
    {
        return $this->status === 'filed';
    }

    public function isClosed(): bool
    {
        return $this->day_closed;
    }
}
