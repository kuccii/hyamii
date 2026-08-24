<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagePrice extends Model
{
    protected $fillable = [
        'package_id',
        'currency_code',
        'monthly_price',
        'annual_price',
    ];

    protected $casts = [
        'monthly_price' => 'float',
        'annual_price' => 'float',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
