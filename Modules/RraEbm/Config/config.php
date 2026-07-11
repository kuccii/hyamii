<?php

return [
    'name' => 'RraEbm',
    'verification_required' => false,
    'envato_item_id' => null,
    'setting' => \Modules\RraEbm\Entities\RraEbmSetting::class,

    /*
    |--------------------------------------------------------------------------
    | RRA EBM API Endpoints
    |--------------------------------------------------------------------------
    */
    'endpoints' => [
        'initialization' => env('RRA_EBM_INIT_ENDPOINT', '/initializer/selectInitInfo'),
        'save_item' => env('RRA_EBM_SAVE_ITEM_ENDPOINT', '/items/saveItems'),
        'sale_transaction' => env('RRA_EBM_SALE_ENDPOINT', '/trnsSales/saveSales'),
        'save_stock_items' => env('RRA_EBM_STOCK_ENDPOINT', '/stock/saveStockItems'),
        'save_stock_master' => env('RRA_EBM_STOCK_MASTER_ENDPOINT', '/stockMaster/saveStockMaster'),
        'save_purchases' => env('RRA_EBM_PURCHASE_ENDPOINT', '/trnsPurchase/savePurchases'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Tax Code Mapping
    |--------------------------------------------------------------------------
    | Maps Hyamii tax percentages to RRA EBM tax codes
    | TAX_A = 0% (Exempt), TAX_B = 18% (Standard), TAX_C = 0% (Export), TAX_D = 0% (Non-taxable)
    */
    'tax_codes' => [
        0 => 'A',
        18 => 'B',
    ],

    'default_tax_code' => 'A',

    /*
    |--------------------------------------------------------------------------
    | Queue Settings
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'connection' => env('RRA_EBM_QUEUE_CONNECTION', 'sync'),
        'max_attempts' => 5,
        'backoff' => [60, 300, 900, 3600, 14400],
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Settings
    |--------------------------------------------------------------------------
    */
    'http' => [
        'timeout' => env('RRA_EBM_HTTP_TIMEOUT', 30),
        'retry_times' => env('RRA_EBM_HTTP_RETRY', 3),
        'retry_delay' => env('RRA_EBM_HTTP_RETRY_DELAY', 100),
    ],
];
