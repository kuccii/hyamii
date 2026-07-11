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
        'get_sales' => env('RRA_EBM_GET_SALES_ENDPOINT', '/trnsSales/getSales'),
        'cancel_sale' => env('RRA_EBM_CANCEL_ENDPOINT', '/trnsSales/cancelSales'),
        'daily_sales_report' => env('RRA_EBM_DAILY_SALES_ENDPOINT', '/report/dailySales'),
        'close_report' => env('RRA_EBM_CLOSE_ENDPOINT', '/report/close'),
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
        -1 => 'C',  // Export (use negative key as sentinel)
        -2 => 'D',  // Non-taxable
        -3 => 'E',  // Other
    ],

    'default_tax_code' => 'A',

    /*
    |--------------------------------------------------------------------------
    | Cancellation Reason Codes
    |--------------------------------------------------------------------------
    */
    'cancel_reason_codes' => [
        'duplicate' => '01',
        'wrong_amount' => '02',
        'order_cancelled' => '03',
        'other' => '09',
    ],

    /*
    |--------------------------------------------------------------------------
    | End-of-Day Settings
    |--------------------------------------------------------------------------
    */
    'eod' => [
        'filing_time' => env('RRA_EBM_EOD_TIME', '23:59'),
        'auto_close' => env('RRA_EBM_AUTO_CLOSE', false),
    ],

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

    /*
    |--------------------------------------------------------------------------
    | Registrar Identity
    |--------------------------------------------------------------------------
    */
    'regr_id' => env('RRA_EBM_REGR_ID', 'Hyamii'),
    'regr_nm' => env('RRA_EBM_REGR_NM', 'Hyamii'),
];
