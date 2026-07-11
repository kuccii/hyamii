<?php

namespace Modules\RraEbm\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmReceiptSignature;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraVerificationService
{
    public function __construct(
        protected RraEbmService $ebmService
    ) {}

    public function verifyReceipt(RraEbmSetting $setting, string $receiptNumber): array
    {
        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'rcptNo' => (int) $receiptNumber,
        ];

        $endpoint = '/trnsSales/getSales';

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                $data = $response->json()['data'] ?? null;

                return [
                    'verified' => true,
                    'data' => $data,
                    'receipt_number' => $receiptNumber,
                ];
            }

            $error = $this->ebmService->getErrorMessage($response);
            Log::error('RRA EBM: receipt verification failed', [
                'receipt_number' => $receiptNumber,
                'error' => $error,
            ]);

            return [
                'verified' => false,
                'error' => $error,
                'receipt_number' => $receiptNumber,
            ];
        } catch (\Exception $e) {
            Log::error('RRA EBM: receipt verification exception', [
                'receipt_number' => $receiptNumber,
                'error' => $e->getMessage(),
            ]);

            return [
                'verified' => false,
                'error' => $e->getMessage(),
                'receipt_number' => $receiptNumber,
            ];
        }
    }

    public function verifyLocalReceipts(RraEbmSetting $setting, string $startDate, string $endDate): array
    {
        $receipts = RraEbmReceiptSignature::whereHas('order', function ($q) use ($setting, $startDate, $endDate) {
            $q->where('branch_id', $setting->branch_id)
              ->where('rra_ebm_submitted', true)
              ->whereBetween('date_time', [$startDate, $endDate]);
        })->get();

        $results = [];
        foreach ($receipts as $receipt) {
            $verification = $this->verifyReceipt($setting, $receipt->receipt_number);
            $results[] = [
                'receipt' => $receipt,
                'verification' => $verification,
            ];
        }

        $verified = count(array_filter($results, fn($r) => $r['verification']['verified']));
        $failed = count($results) - $verified;

        return [
            'total' => count($results),
            'verified' => $verified,
            'failed' => $failed,
            'results' => $results,
        ];
    }

    public function getDailySalesReport(RraEbmSetting $setting, string $salesDate): ?array
    {
        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'salesDate' => Carbon::parse($salesDate)->format('Ymd'),
        ];

        $endpoint = config('rraebm.endpoints.daily_sales_report', '/report/dailySales');

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                return $response->json()['data'] ?? null;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('RRA EBM: daily sales report query failed', [
                'date' => $salesDate,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
