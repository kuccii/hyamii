<?php

namespace App\Models;

use App\Enums\PackageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Package extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'package_type' => PackageType::class,
        'trial_days' => 'integer',
        'trial_notification_before_days' => 'integer',
    ];

    const ADDITIONAL_FEATURES = [
        'Change Branch',
        'Export Report',
        'Table Reservation',
        'Payment Gateway Integration',
        'Theme Setting',
        'Customer Display',
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'package_modules');
    }

    public function prices()
    {
        return $this->hasMany(PackagePrice::class);
    }

    /**
     * Resolve a localized price for a currency, falling back to USD then the package base price.
     */
    public function localizedPrice(string $currencyCode): ?PackagePrice
    {
        return $this->prices()
            ->where('currency_code', $currencyCode)
            ->first()
            ?? $this->prices()->where('currency_code', 'USD')->first();
    }

    public function currency()
    {
        return $this->belongsTo(GlobalCurrency::class, 'currency_id');
    }

    public function hasModule($moduleId)
    {
        return $this->modules()->where('module_id', $moduleId)->exists();
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'package_id');
    }
}
