<?php

namespace Modules\RraEbm\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmEodFiling;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraEodService
{
    public function __construct(
        protected RraEbmService $ebmService
    ) {}

    public function fileDailySales(RraEbmSetting $setting, string $salesDate): array
    {
        $startOfDay = Carbon::parse($salesDate)->startOfDay()->format('Y-m-d H:i:s');
        $endOfDay = Carbon::parse($salesDate)->endOfDay()->format('Y-m-d H:i:s');

        $orders = Order::where('branch_id', $setting->branch_id)
            ->where('status', 'paid')
            ->where('rra_ebm_submitted', true)
            ->whereBetween('date_time', [$startOfDay, $endOfDay])
            ->get();

        $totalSalesCount = $orders->count();
        $totalSalesAmount = round($orders->sum('total'), 2);
        $totalTaxAmount = round($orders->sum('total_tax_amount'), 2);

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'salesDate' => Carbon::parse($salesDate)->format('Ymd'),
            'totSaleAmt' => $totalSalesAmount,
            'totTaxAmt' => $totalTaxAmount,
            'totItemCnt' => $orders->sum(fn($o) => $o->items->sum('quantity')),
        ];

        $endpoint = config('rraebm.endpoints.daily_sales_report', '/report/dailySales');

        try {
            $response = $this->ebmService->post($setting, $endpoint, $payload);

            if ($this->ebmService->isSuccessful($response)) {
                $filing = RraEbmEodFiling::create([
                    'branch_id' => $setting->branch_id,
                    'filing_date' => $salesDate,
                    'total_orders' => $totalSalesCount,
                    'total_sales_amount' => $totalSalesAmount,
                    'total_tax_amount' => $totalTaxAmount,
                    'status' => 'filed',
                    'filed_at' => now(),
                    'rra_response' => $response->json(),
                ]);

                Log::info('RRA EBM: daily sales filed', [
                    'branch_id' => $setting->branch_id,
                    'date' => $salesDate,
                    'orders' => $totalSalesCount,
                ]);

                return ['success' => true, 'filing' => $filing];
            }

            $error = $this->ebmService->getErrorMessage($response);
            $this->recordFailedFiling($setting, $salesDate, $totalSalesCount, $totalSalesAmount, $totalTaxAmount, $error);

            return ['success' => false, 'error' => $error];
        } catch (\Exception $e) {
            $this->recordFailedFiling($setting, $salesDate, $totalSalesCount, $totalSalesAmount, $totalTaxAmount, $e->getMessage());

            throw $e;
        }
    }

    public function closeDay(RraEbmSetting $setting, string $closeDate): bool
    {
        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'closeDate' => Carbon::parse($closeDate)->format('Ymd'),
        ];

        $endpoint = config('rraebm.endpoints.close_report', '/report/close');

        $response = $this->ebmService->post($setting, $endpoint, $payload);

        if ($this->ebmService->isSuccessful($response)) {
            RraEbmEodFiling::where('branch_id', $setting->branch_id)
                ->where('filing_date', $closeDate)
                ->update(['day_closed' => true, 'closed_at' => now()]);

            Log::info('RRA EBM: day closed', [
                'branch_id' => $setting->branch_id,
                'date' => $closeDate,
            ]);

            return true;
        }

        $error = $this->ebmService->getErrorMessage($response);
        Log::error('RRA EBM: day close failed', [
            'branch_id' => $setting->branch_id,
            'date' => $closeDate,
            'error' => $error,
        ]);

        return false;
    }

    public function getFiledDates(RraEbmSetting $setting, string $startDate, string $endDate): array
    {
        return RraEbmEodFiling::where('branch_id', $setting->branch_id)
            ->whereBetween('filing_date', [$startDate, $endDate])
            ->orderBy('filing_date')
            ->get()
            ->keyBy('filing_date')
            ->toArray();
    }

    public function getUnfiledDates(RraEbmSetting $setting, string $startDate, string $endDate): array
    {
        $filedDates = $this->getFiledDates($setting, $startDate, $endDate);

        $dates = [];
        $current = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        while ($current->lte($end)) {
            $dateStr = $current->format('Y-m-d');
            if (!isset($filedDates[$dateStr])) {
                $hasOrders = Order::where('branch_id', $setting->branch_id)
                    ->where('status', 'paid')
                    ->where('date_time', '>=', $current->startOfDay())
                    ->where('date_time', '<=', $current->endOfDay())
                    ->exists();

                if ($hasOrders) {
                    $dates[] = $dateStr;
                }
            }
            $current->addDay();
        }

        return $dates;
    }

    private function recordFailedFiling(RraEbmSetting $setting, string $salesDate, int $totalSalesCount, float $totalSalesAmount, float $totalTaxAmount, string $error): void
    {
        RraEbmEodFiling::updateOrCreate(
            [
                'branch_id' => $setting->branch_id,
                'filing_date' => $salesDate,
            ],
            [
                'total_orders' => $totalSalesCount,
                'total_sales_amount' => $totalSalesAmount,
                'total_tax_amount' => $totalTaxAmount,
                'status' => 'failed',
                'error_message' => $error,
            ]
        );
    }
}
