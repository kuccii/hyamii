<?php

namespace Modules\RraEbm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class RraEbmInvoiceSequence extends Model
{
    protected $guarded = ['id'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public static function nextInvoiceNumber(int $branchId): string
    {
        return DB::transaction(function () use ($branchId) {
            $sequence = static::where('branch_id', $branchId)
                ->lockForUpdate()
                ->first();

            if (!$sequence) {
                $sequence = static::create([
                    'branch_id' => $branchId,
                    'last_number' => 1,
                ]);
                return str_pad('1', 10, '0', STR_PAD_LEFT);
            }

            $sequence->increment('last_number');

            return str_pad((string) $sequence->last_number, 10, '0', STR_PAD_LEFT);
        });
    }
}
