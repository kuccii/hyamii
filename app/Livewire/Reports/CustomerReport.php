<?php

namespace App\Livewire\Reports;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerReportExport;

class CustomerReport extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $dateRangeType;
    public $startDate;
    public $endDate;
    public $startTime = '00:00';
    public $endTime = '23:59';
    public $search = '';
    public $orderTypeFilter = '';
    public $statusFilter = '';
    public $activeTab = 'all';
    public $minOrders = '';
    public $minSpend = '';
    public $itemFilter = '';

    public $showCustomerProfileModal = false;
    public $selectedCustomerId = null;
    public $selectedCustomerName = '';
    public $selectedCustomerOrders = [];
    public $selectedCustomerTotals = [];
    public $selectedCustomerReservations = [];
    public $selectedCustomerAddresses = [];
    public $selectedCustomerLifetimeStats = [];

    public $sortField = 'orders_count';
    public $sortDirection = 'desc';

    private $cachedStats = null;
    private $cachedPreferredTypes = null;
    private $cachedPaymentMethods = null;
    private $cachedLoyalty = null;
    private $cachedItemsCounts = null;
    private $cachedPreviousStats = null;
    private $cachedFirstOrderEver = null;
    private $cachedFavoriteItems = null;
    private $cachedOrderedMenuItems = null;
    private $cachedTopItemsData = null;
    private $cachedChartsPayload = null;
    private $cachedChartsFingerprint = null;

    public function mount()
    {
        abort_if(!in_array('Report', restaurant_modules()), 403);
        abort_if((!user_can('Show Reports')), 403);

        $tz = timezone();
        $this->dateRangeType = request()->cookie('customer_report_date_range_type', 'currentMonth');
        $this->setDateRange();
    }

    public function updatedDateRangeType($value)
    {
        cookie()->queue(cookie('customer_report_date_range_type', $value, 60 * 24 * 30));
        $this->setDateRange();
        $this->resetPage();
        $this->invalidateCache();
    }

    public function updatedSearch($value)
    {
        $this->resetPage();
    }

    public function updatedOrderTypeFilter($value)
    {
        $this->resetPage();
        $this->invalidateCache();
    }

    public function updatedStatusFilter($value)
    {
        $this->resetPage();
        $this->invalidateCache();
    }

    public function updatedActiveTab($value)
    {
        $this->resetPage();
    }

    public function updatedMinOrders($value)
    {
        $this->resetPage();
        $this->invalidateCache();
    }

    public function updatedMinSpend($value)
    {
        $this->resetPage();
        $this->invalidateCache();
    }

    public function updatedItemFilter($value)
    {
        $this->resetPage();
        $this->invalidateCache();
    }

    public function updatedStartTime($value)
    {
        $this->invalidateCache();
    }

    public function updatedEndTime($value)
    {
        $this->invalidateCache();
    }

    public function updatedStartDate($value)
    {
        $this->invalidateCache();
    }

    public function updatedEndDate($value)
    {
        $this->invalidateCache();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'desc';
        }
        $this->resetPage();
    }

    public function setDateRange()
    {
        $tz = timezone();
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';

        switch ($this->dateRangeType) {
            case 'today':
                $this->startDate = Carbon::now($tz)->startOfDay()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->startOfDay()->format($dateFormat);
                break;
            case 'currentWeek':
                $this->startDate = Carbon::now($tz)->startOfWeek()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->startOfDay()->format($dateFormat);
                break;
            case 'lastWeek':
                $this->startDate = Carbon::now($tz)->subWeek()->startOfWeek()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->subWeek()->endOfWeek()->format($dateFormat);
                break;
            case 'last7Days':
                $this->startDate = Carbon::now($tz)->subDays(7)->format($dateFormat);
                $this->endDate = Carbon::now($tz)->startOfDay()->format($dateFormat);
                break;
            case 'currentMonth':
                $this->startDate = Carbon::now($tz)->startOfMonth()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->startOfDay()->format($dateFormat);
                break;
            case 'lastMonth':
                $this->startDate = Carbon::now($tz)->subMonth()->startOfMonth()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->subMonth()->endOfMonth()->format($dateFormat);
                break;
            case 'currentYear':
                $this->startDate = Carbon::now($tz)->startOfYear()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->startOfDay()->format($dateFormat);
                break;
            case 'lastYear':
                $this->startDate = Carbon::now($tz)->subYear()->startOfYear()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->subYear()->endOfYear()->format($dateFormat);
                break;
            default:
                $this->startDate = Carbon::now($tz)->startOfWeek()->format($dateFormat);
                $this->endDate = Carbon::now($tz)->endOfWeek()->format($dateFormat);
                break;
        }
    }

    private function prepareDateTimeData()
    {
        $timezone = timezone();
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';

        $startTimeStr = $this->startTime ?: '00:00';
        $endTimeStr = $this->endTime ?: '23:59';

        $startDateCarbon = Carbon::createFromFormat($dateFormat, $this->startDate, $timezone);
        $endDateCarbon = Carbon::createFromFormat($dateFormat, $this->endDate, $timezone);

        $startDateTime = $startDateCarbon->copy()->setTimeFromTimeString($startTimeStr)->setTimezone('UTC')->toDateTimeString();
        $endDateTime = $endDateCarbon->copy()->setTimeFromTimeString($endTimeStr)->setTimezone('UTC')->toDateTimeString();

        return [
            'timezone' => $timezone,
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'startTime' => $startTimeStr,
            'endTime' => $endTimeStr,
        ];
    }

    private function invalidateCache()
    {
        $this->cachedStats = null;
        $this->cachedPreferredTypes = null;
        $this->cachedPaymentMethods = null;
        $this->cachedLoyalty = null;
        $this->cachedItemsCounts = null;
        $this->cachedPreviousStats = null;
        $this->cachedFirstOrderEver = null;
        $this->cachedFavoriteItems = null;
        $this->cachedOrderedMenuItems = null;
        $this->cachedTopItemsData = null;
        $this->cachedChartsPayload = null;
        $this->cachedChartsFingerprint = null;
    }

    private function getChartsFingerprint(array $dateTimeData): string
    {
        return md5(implode('|', [
            $dateTimeData['startDateTime'],
            $dateTimeData['endDateTime'],
            $this->startTime,
            $this->endTime,
            $this->orderTypeFilter,
            $this->statusFilter,
        ]));
    }

    private function applyDateTimeOfDayFilter($query, array $dateTimeData, string $column = 'date_time')
    {
        $offset = Carbon::now($dateTimeData['timezone'])->format('P');

        return $query->where(function ($q) use ($dateTimeData, $offset, $column) {
            if ($dateTimeData['startTime'] < $dateTimeData['endTime']) {
                $q->whereRaw("TIME(CONVERT_TZ({$column}, '+00:00', ?)) BETWEEN ? AND ?", [$offset, $dateTimeData['startTime'], $dateTimeData['endTime']]);
            } else {
                $q->where(function ($sub) use ($dateTimeData, $offset, $column) {
                    $sub->whereRaw("TIME(CONVERT_TZ({$column}, '+00:00', ?)) >= ?", [$offset, $dateTimeData['startTime']])
                        ->orWhereRaw("TIME(CONVERT_TZ({$column}, '+00:00', ?)) <= ?", [$offset, $dateTimeData['endTime']]);
                });
            }
        });
    }

    private function applyOrderFilters($query)
    {
        if ($this->orderTypeFilter) {
            $query->where('order_type', $this->orderTypeFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query;
    }

    private function getStatsQuery($dateTimeData)
    {
        $query = Order::select('customer_id',
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('COALESCE(SUM(total), 0) as total_revenue'),
                DB::raw('COALESCE(AVG(total), 0) as avg_order_value'),
                DB::raw('MIN(date_time) as first_order_date'),
                DB::raw('MAX(date_time) as last_order_date'),
                DB::raw('COALESCE(SUM(discount_amount), 0) as total_discount'))
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereNotNull('customer_id')
            ->whereBetween('date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']]);

        $this->applyDateTimeOfDayFilter($query, $dateTimeData);

        $this->applyOrderFilters($query);

        return $query;
    }

    private function getOrderStats()
    {
        if ($this->cachedStats !== null) {
            return $this->cachedStats;
        }

        $dateTimeData = $this->prepareDateTimeData();
        $query = $this->getStatsQuery($dateTimeData);

        $this->cachedStats = $query->groupBy('customer_id')->get()->keyBy('customer_id');
        return $this->cachedStats;
    }

    private function getStatsForPeriod($startDateTime, $endDateTime, $startTime, $endTime)
    {
        $timezone = timezone();
        $dateTimeData = [
            'timezone' => $timezone,
            'startDateTime' => $startDateTime,
            'endDateTime' => $endDateTime,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];

        $offset = Carbon::now($timezone)->format('P');

        $query = Order::select(
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('COALESCE(SUM(total), 0) as total_revenue'))
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereNotNull('customer_id')
            ->whereBetween('date_time', [$startDateTime, $endDateTime]);

        $query->where(function ($q) use ($startTime, $endTime, $offset, $timezone) {
            if ($startTime < $endTime) {
                $q->whereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) BETWEEN ? AND ?", [$offset, $startTime, $endTime]);
            } else {
                $q->where(function ($sub) use ($offset, $startTime, $endTime) {
                    $sub->whereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) >= ?", [$offset, $startTime])
                        ->orWhereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) <= ?", [$offset, $endTime]);
                });
            }
        });

        $result = $query->first();
        return [
            'customers' => Order::where('branch_id', branch()->id)
                ->whereNotIn('status', ['draft', 'canceled'])
                ->whereNotNull('customer_id')
                ->whereBetween('date_time', [$startDateTime, $endDateTime])
                ->distinct('customer_id')
                ->count('customer_id'),
            'orders' => (int) ($result->orders_count ?? 0),
            'revenue' => (float) ($result->total_revenue ?? 0),
        ];
    }

    private function getItemsCounts($customerIds)
    {
        if ($this->cachedItemsCounts !== null) {
            return $this->cachedItemsCounts;
        }

        if ($customerIds->isEmpty()) {
            return collect();
        }

        $dateTimeData = $this->prepareDateTimeData();

        $rows = DB::table('orders')
            ->select('orders.customer_id', DB::raw('COALESCE(SUM(order_items.quantity), 0) as items_count'))
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereIn('orders.customer_id', $customerIds)
            ->where('orders.branch_id', branch()->id)
            ->whereNotIn('orders.status', ['draft', 'canceled'])
            ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->groupBy('orders.customer_id')
            ->get();

        $this->cachedItemsCounts = $rows->keyBy('customer_id')->map(function ($r) {
            return (int) $r->items_count;
        });

        return $this->cachedItemsCounts;
    }

    private function getFirstOrderEver($customerIds)
    {
        if ($this->cachedFirstOrderEver !== null) {
            return $this->cachedFirstOrderEver;
        }

        if ($customerIds->isEmpty()) {
            return collect();
        }

        $rows = Order::select('customer_id', DB::raw('MIN(date_time) as first_order_ever'))
            ->whereIn('customer_id', $customerIds)
            ->where('branch_id', branch()->id)
            ->groupBy('customer_id')
            ->get();

        $this->cachedFirstOrderEver = $rows->keyBy('customer_id')->map(function ($r) {
            return $r->first_order_ever;
        });

        return $this->cachedFirstOrderEver;
    }

    private function getPreferredOrderTypes($customerIds)
    {
        if ($this->cachedPreferredTypes !== null) {
            return $this->cachedPreferredTypes;
        }

        if ($customerIds->isEmpty()) {
            return collect();
        }

        $dateTimeData = $this->prepareDateTimeData();

        $rows = Order::select('customer_id', 'order_type', DB::raw('COUNT(*) as type_count'))
            ->whereIn('customer_id', $customerIds)
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereBetween('date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->groupBy('customer_id', 'order_type')
            ->orderBy('type_count', 'desc')
            ->get();

        $this->cachedPreferredTypes = $rows->groupBy('customer_id')->map(function ($items) {
            return $items->first()->order_type;
        });

        return $this->cachedPreferredTypes;
    }

    private function getOrderTypeBreakdowns($customerIds)
    {
        if ($customerIds->isEmpty()) {
            return collect();
        }

        $dateTimeData = $this->prepareDateTimeData();

        $rows = Order::select('customer_id', 'order_type', DB::raw('COUNT(*) as type_count'))
            ->whereIn('customer_id', $customerIds)
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereBetween('date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->groupBy('customer_id', 'order_type')
            ->get();

        return $rows->groupBy('customer_id');
    }

    private function getPaymentMethods($customerIds)
    {
        if ($this->cachedPaymentMethods !== null) {
            return $this->cachedPaymentMethods;
        }

        if ($customerIds->isEmpty()) {
            return collect();
        }

        $dateTimeData = $this->prepareDateTimeData();

        $rows = Payment::select('orders.customer_id',
                'payments.payment_method',
                DB::raw('COUNT(*) as payment_count'),
                DB::raw('COALESCE(SUM(payments.amount), 0) as payment_total'))
            ->join('orders', 'payments.order_id', '=', 'orders.id')
            ->whereIn('orders.customer_id', $customerIds)
            ->where('orders.branch_id', branch()->id)
            ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->groupBy('orders.customer_id', 'payments.payment_method')
            ->get();

        $this->cachedPaymentMethods = $rows->groupBy('customer_id');
        return $this->cachedPaymentMethods;
    }

    private function getLoyaltyPoints($customerIds)
    {
        if ($this->cachedLoyalty !== null) {
            return $this->cachedLoyalty;
        }

        if ($customerIds->isEmpty() || !module_enabled('Loyalty')) {
            return collect();
        }

        try {
            $rows = DB::table('loyalty_accounts')
                ->select('customer_id', DB::raw('CAST(COALESCE(points_balance, 0) AS UNSIGNED) as loyalty_points'))
                ->whereIn('customer_id', $customerIds)
                ->where('restaurant_id', restaurant()->id)
                ->get();

            $this->cachedLoyalty = $rows->keyBy('customer_id')->map(function ($item) {
                return (int) $item->loyalty_points;
            });
        } catch (\Exception $e) {
            $this->cachedLoyalty = collect();
        }

        return $this->cachedLoyalty;
    }

    private function getPreviousPeriodData()
    {
        if ($this->cachedPreviousStats !== null) {
            return $this->cachedPreviousStats;
        }

        $tz = timezone();
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';

        $startCarbon = Carbon::createFromFormat($dateFormat, $this->startDate, $tz);
        $endCarbon = Carbon::createFromFormat($dateFormat, $this->endDate, $tz);
        $diffDays = $startCarbon->diffInDays($endCarbon) + 1;

        $prevEnd = $startCarbon->copy()->subDay();
        $prevStart = $prevEnd->copy()->subDays($diffDays - 1);

        $prevStartUTC = $prevStart->copy()->setTimeFromTimeString($this->startTime ?: '00:00')->setTimezone('UTC')->toDateTimeString();
        $prevEndUTC = $prevEnd->copy()->setTimeFromTimeString($this->endTime ?: '23:59')->setTimezone('UTC')->toDateTimeString();

        $this->cachedPreviousStats = $this->getStatsForPeriod(
            $prevStartUTC, $prevEndUTC,
            $this->startTime ?: '00:00',
            $this->endTime ?: '23:59'
        );

        return $this->cachedPreviousStats;
    }

    private function computeBadges($customerData, $periodStartDate, $periodEndDate)
    {
        $customerIds = collect($customerData)->pluck('customer.id')->filter()->unique();
        $firstOrders = $this->getFirstOrderEver($customerIds);

        $revenues = collect($customerData)->pluck('total_revenue')->sort()->values();
        $vipThreshold = 0;
        if ($revenues->count() > 0) {
            $idx = (int) ceil(0.8 * $revenues->count()) - 1;
            $idx = max(0, min($idx, $revenues->count() - 1));
            $vipThreshold = $revenues->get($idx);
        }

        $tz = timezone();
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';
        $periodStart = Carbon::createFromFormat($dateFormat, $periodStartDate, $tz);
        $periodEnd = Carbon::createFromFormat($dateFormat, $periodEndDate, $tz);

        $badges = [];
        foreach ($customerData as $item) {
            $cid = $item['customer']->id;
            $badge = [];

            if ($item['total_revenue'] >= $vipThreshold && $vipThreshold > 0 && $item['total_revenue'] > 0) {
                $badge[] = 'vip';
            }

            $firstOrderEver = $firstOrders->get($cid);
            if ($firstOrderEver) {
                $firstEver = Carbon::parse($firstOrderEver);
                $startUTC = $periodStart->copy()->setTimeFromTimeString($this->startTime ?: '00:00')->setTimezone('UTC');
                $endUTC = $periodEnd->copy()->setTimeFromTimeString($this->endTime ?: '23:59')->setTimezone('UTC');
                if ($firstEver->between($startUTC, $endUTC)) {
                    $badge[] = 'new';
                }
            }

            if ($item['orders_count'] >= 2) {
                $badge[] = 'repeat';
            }

            if ($item['last_order_date']) {
                $lastOrder = Carbon::parse($item['last_order_date']);
                $periodEndUTC = $periodEnd->copy()->setTimeFromTimeString($this->endTime ?: '23:59')->setTimezone('UTC');
                if ($lastOrder->diffInDays($periodEndUTC) > 30) {
                    $badge[] = 'at_risk';
                }
            }

            $badges[$cid] = $badge;
        }

        return $badges;
    }

    public function getTopCustomersChartData()
    {
        $dateTimeData = $this->prepareDateTimeData();
        $stats = $this->getOrderStats();
        $customerIds = $stats->pluck('customer_id')->filter()->unique();
        $customers = Customer::whereIn('id', $customerIds)->get()->keyBy('id');

        $data = [];
        foreach ($stats as $stat) {
            $customer = $customers->get($stat->customer_id);
            if (!$customer) continue;
            $data[] = [
                'name' => $customer->name ?? 'Unknown',
                'revenue' => (float) $stat->total_revenue,
            ];
        }

        usort($data, fn($a, $b) => $b['revenue'] <=> $a['revenue']);
        return array_slice($data, 0, 10);
    }

    public function getCustomerGrowthChartData()
    {
        $dateTimeData = $this->prepareDateTimeData();
        $tz = $dateTimeData['timezone'];
        $offset = Carbon::now($tz)->format('P');

        $startCarbon = Carbon::parse($dateTimeData['startDateTime'])->setTimezone($tz)->startOfDay();
        $endCarbon = Carbon::parse($dateTimeData['endDateTime'])->setTimezone($tz)->startOfDay();
        $diffDays = $startCarbon->diffInDays($endCarbon);

        if ($diffDays <= 60) {
            $periodLabel = 'day';
            $periodExpression = "DATE_FORMAT(CONVERT_TZ(first_order_at, '+00:00', '{$offset}'), '%Y-%m-%d')";
        } elseif ($diffDays <= 180) {
            $periodLabel = 'week';
            $periodExpression = "DATE_FORMAT(DATE_SUB(CONVERT_TZ(first_order_at, '+00:00', '{$offset}'), INTERVAL WEEKDAY(CONVERT_TZ(first_order_at, '+00:00', '{$offset}')) DAY), '%Y-%m-%d')";
        } else {
            $periodLabel = 'month';
            $periodExpression = "DATE_FORMAT(CONVERT_TZ(first_order_at, '+00:00', '{$offset}'), '%Y-%m')";
        }

        $firstOrdersSub = DB::table('orders')
            ->select('customer_id', DB::raw('MIN(date_time) as first_order_at'))
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereNotNull('customer_id')
            ->groupBy('customer_id');

        $this->applyOrderFilters($firstOrdersSub);

        $rows = DB::query()
            ->fromSub($firstOrdersSub, 'first_orders')
            ->select(
                DB::raw("{$periodExpression} as period"),
                DB::raw('COUNT(*) as new_customers')
            )
            ->whereBetween('first_order_at', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']]);

        $this->applyDateTimeOfDayFilter($rows, $dateTimeData, 'first_order_at');

        $rows = $rows
            ->groupBy('period')
            ->orderBy('period')
            ->get()
            ->keyBy('period');

        $labels = [];
        $data = [];
        $cursor = $startCarbon->copy();

        while ($cursor <= $endCarbon) {
            if ($periodLabel === 'day') {
                $key = $cursor->format('Y-m-d');
                $cursor->addDay();
            } elseif ($periodLabel === 'week') {
                $key = $cursor->copy()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $cursor->addWeek();
            } else {
                $key = $cursor->format('Y-m');
                $cursor->addMonth()->startOfMonth();
            }

            $labels[] = $key;
            $data[] = (int) ($rows->get($key)->new_customers ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'periodLabel' => $periodLabel,
        ];
    }

    public function getChartsPayload(array $dateTimeData): array
    {
        $fingerprint = $this->getChartsFingerprint($dateTimeData);

        if ($this->cachedChartsPayload !== null && $this->cachedChartsFingerprint === $fingerprint) {
            return $this->cachedChartsPayload;
        }

        $topCustomers = $this->getTopCustomersChartData();
        $growthChart = $this->getCustomerGrowthChartData();

        $this->cachedChartsPayload = [
            'hash' => $fingerprint,
            'topCustomers' => [
                'categories' => array_column($topCustomers, 'name'),
                'series' => array_map(fn ($row) => (float) $row['revenue'], $topCustomers),
            ],
            'customerGrowth' => [
                'labels' => collect($growthChart['labels'])->values()->all(),
                'data' => collect($growthChart['data'])->map(fn ($v) => (int) $v)->values()->all(),
            ],
            'currencySymbol' => currency(),
        ];
        $this->cachedChartsFingerprint = $fingerprint;

        return $this->cachedChartsPayload;
    }

    public function getCohortRetentionData()
    {
        $tz = timezone();
        $offset = Carbon::now($tz)->format('P');

        $firstOrders = DB::table('orders')
            ->select('customer_id', DB::raw('MIN(date_time) as first_order_date'))
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->get();

        $cohorts = [];
        foreach ($firstOrders as $fo) {
            $cohortMonth = Carbon::parse($fo->first_order_date)->setTimezone($tz)->format('Y-m');
            if (!isset($cohorts[$cohortMonth])) {
                $cohorts[$cohortMonth] = ['cohort' => $cohortMonth, 'size' => 0, 'months' => []];
            }
            $cohorts[$cohortMonth]['size']++;
        }
        ksort($cohorts);

        $allOrderMonths = DB::table('orders')
            ->select('customer_id', DB::raw("DATE_FORMAT(CONVERT_TZ(date_time, '+00:00', ?), '%Y-%m') as order_month"))
            ->addBinding([$offset], 'select')
            ->where('branch_id', branch()->id)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereNotNull('customer_id')
            ->groupBy('customer_id', 'order_month')
            ->orderBy('order_month')
            ->get()
            ->groupBy('customer_id');

        foreach ($cohorts as $cm => &$cohort) {
            $cohortStart = Carbon::createFromFormat('Y-m', $cm, $tz)->startOfMonth();
            $cohortCustomers = $firstOrders->where('first_order_date', '>=', $cohortStart->copy()->setTimezone('UTC')->toDateTimeString())
                ->where('first_order_date', '<', $cohortStart->copy()->addMonth()->setTimezone('UTC')->toDateTimeString())
                ->pluck('customer_id');

            foreach ($cohortCustomers as $cid) {
                $customerMonths = $allOrderMonths->get($cid, collect())->pluck('order_month')->unique()->sort()->values();
                foreach ($customerMonths as $idx => $om) {
                    if ($idx === 0) continue;
                    $monthKey = 'month_' . $idx;
                    if (!isset($cohort['months'][$monthKey])) {
                        $cohort['months'][$monthKey] = 0;
                    }
                    $cohort['months'][$monthKey]++;
                }
            }
        }
        unset($cohort);

        return array_values($cohorts);
    }

    private function getFavoriteItems($customerIds)
    {
        if ($this->cachedFavoriteItems !== null) {
            return $this->cachedFavoriteItems;
        }

        if ($customerIds->isEmpty()) {
            return collect();
        }

        $dateTimeData = $this->prepareDateTimeData();

        $rows = DB::table('order_items')
            ->select('orders.customer_id',
                'order_items.menu_item_id',
                'menu_items.item_name',
                DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_qty'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->whereIn('orders.customer_id', $customerIds)
            ->where('orders.branch_id', branch()->id)
            ->whereNotIn('orders.status', ['draft', 'canceled'])
            ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->groupBy('orders.customer_id', 'order_items.menu_item_id', 'menu_items.item_name')
            ->orderBy('orders.customer_id')
            ->orderByDesc('total_qty')
            ->get();

        $this->cachedFavoriteItems = $rows->groupBy('customer_id')->map(function ($items) {
            return $items->map(function ($r) {
                return ['name' => $r->item_name, 'qty' => (int) $r->total_qty];
            })->values();
        });

        return $this->cachedFavoriteItems;
    }

    private function getOrderedMenuItems()
    {
        if ($this->cachedOrderedMenuItems !== null) {
            return $this->cachedOrderedMenuItems;
        }

        $dateTimeData = $this->prepareDateTimeData();

        $this->cachedOrderedMenuItems = DB::table('order_items')
            ->select('order_items.menu_item_id as id', 'menu_items.item_name as name')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->where('orders.branch_id', branch()->id)
            ->whereNotIn('orders.status', ['draft', 'canceled'])
            ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->distinct()
            ->orderBy('menu_items.item_name')
            ->get();

        return $this->cachedOrderedMenuItems;
    }

    private function getTopItemsData($customerIds = null)
    {
        if ($this->cachedTopItemsData !== null) {
            return $this->cachedTopItemsData;
        }

        $dateTimeData = $this->prepareDateTimeData();

        $query = DB::table('order_items')
            ->select('order_items.menu_item_id',
                'menu_items.item_name',
                'item_categories.category_name',
                DB::raw('COALESCE(SUM(order_items.quantity), 0) as qty_sold'),
                DB::raw('COALESCE(SUM(order_items.amount), 0) as total_rev'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->leftJoin('item_categories', 'menu_items.item_category_id', '=', 'item_categories.id')
            ->where('orders.branch_id', branch()->id)
            ->whereNotIn('orders.status', ['draft', 'canceled'])
            ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']]);

        if ($customerIds !== null && $customerIds->isNotEmpty()) {
            $query->whereIn('orders.customer_id', $customerIds);
        }

        $this->cachedTopItemsData = $query
            ->groupBy('order_items.menu_item_id', 'menu_items.item_name', 'item_categories.category_name')
            ->orderByDesc('qty_sold')
            ->limit(10)
            ->get()
            ->toArray();

        return $this->cachedTopItemsData;
    }

    public function openCustomerProfile($customerId)
    {
        $customer = Customer::find($customerId);
        if (!$customer) return;

        $this->selectedCustomerId = $customerId;
        $this->selectedCustomerName = $customer->name;
        $this->loadCustomerProfile($customerId);
        $this->showCustomerProfileModal = true;
    }

    public function closeCustomerProfile()
    {
        $this->showCustomerProfileModal = false;
        $this->selectedCustomerId = null;
        $this->selectedCustomerName = '';
        $this->selectedCustomerOrders = [];
        $this->selectedCustomerTotals = [];
        $this->selectedCustomerReservations = [];
        $this->selectedCustomerAddresses = [];
        $this->selectedCustomerLifetimeStats = [];
    }

    private function loadCustomerProfile($customerId)
    {
        $dateTimeData = $this->prepareDateTimeData();

        $orders = Order::with('items.menuItem', 'items.menuItemVariation', 'items.modifierOptions', 'payments', 'orderType', 'customer', 'table', 'kot', 'waiter')
            ->where('branch_id', branch()->id)
            ->where('customer_id', $customerId)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->whereBetween('date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->orderBy('date_time', 'desc')
            ->get();

        $this->selectedCustomerOrders = $orders;
        $this->selectedCustomerTotals = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->sum('total'),
            'total_discount' => $orders->sum('discount_amount'),
        ];

        $this->selectedCustomerReservations = [];
        if (\Schema::hasTable('reservations')) {
            try {
                $this->selectedCustomerReservations = DB::table('reservations')
                    ->where('customer_id', $customerId)
                    ->where('branch_id', branch()->id)
                    ->orderBy('reservation_date_time', 'desc')
                    ->take(10)
                    ->get()
                    ->toArray();
            } catch (\Exception $e) {
                $this->selectedCustomerReservations = [];
            }
        }

        $customerModel = Customer::find($customerId);
        if ($customerModel) {
            $this->selectedCustomerAddresses = $customerModel->addresses()->take(5)->get()->toArray();
        } else {
            $this->selectedCustomerAddresses = [];
        }

        $allTimeStats = Order::where('branch_id', branch()->id)
            ->where('customer_id', $customerId)
            ->whereNotIn('status', ['draft', 'canceled'])
            ->selectRaw('COUNT(*) as all_orders, COALESCE(SUM(total), 0) as all_revenue, MIN(date_time) as first_order_ever')
            ->first();

        $this->selectedCustomerLifetimeStats = [
            'all_orders' => (int) ($allTimeStats->all_orders ?? 0),
            'all_revenue' => (float) ($allTimeStats->all_revenue ?? 0),
            'first_order_ever' => $allTimeStats->first_order_ever ?? null,
        ];
    }

    public function exportReport()
    {
        if (!in_array('Export Report', restaurant_modules())) {
            $this->dispatch('showUpgradeLicense');
            return;
        }

        $dateTimeData = $this->prepareDateTimeData();
        $orderStats = $this->getOrderStats();
        $customerIds = $orderStats->pluck('customer_id')->filter()->unique();
        $preferredTypes = $this->getPreferredOrderTypes($customerIds);
        $loyaltyPoints = $this->getLoyaltyPoints($customerIds);
        $itemsCounts = $this->getItemsCounts($customerIds);
        $favoriteItems = $this->getFavoriteItems($customerIds);
        $customers = Customer::whereIn('id', $customerIds)->get()->keyBy('id');

        $data = [];
        foreach ($orderStats as $stat) {
            $customer = $customers->get($stat->customer_id);
            if (!$customer) continue;

            $fav = $favoriteItems->get($stat->customer_id);
            $topItem = $fav ? $fav->first() : null;

            $data[] = [
                'customer' => $customer,
                'orders_count' => $stat->orders_count,
                'total_revenue' => $stat->total_revenue,
                'avg_order_value' => $stat->avg_order_value,
                'first_order_date' => $stat->first_order_date,
                'last_order_date' => $stat->last_order_date,
                'total_discount' => $stat->total_discount,
                'preferred_type' => $preferredTypes->get($stat->customer_id),
                'loyalty_points' => $loyaltyPoints->get($stat->customer_id, 0),
                'items_count' => $itemsCounts->get($stat->customer_id, 0),
                'top_item_name' => $topItem['name'] ?? null,
                'top_item_qty' => $topItem['qty'] ?? 0,
            ];
        }

        $timeFormat = restaurant()->time_format ?? 'h:i A';
        $formattedStartTime = Carbon::createFromFormat('H:i', $this->startTime)->format($timeFormat);
        $formattedEndTime = Carbon::createFromFormat('H:i', $this->endTime)->format($timeFormat);

        return Excel::download(
            new CustomerReportExport(
                $data,
                $this->startDate,
                $this->endDate,
                $formattedStartTime,
                $formattedEndTime,
                $dateTimeData['timezone']
            ),
            'customer-report-' . now()->format('Y-m-d_His') . '.xlsx'
        );
    }

    public function render()
    {
        $dateTimeData = $this->prepareDateTimeData();
        $orderStats = $this->getOrderStats();
        $customerIds = $orderStats->pluck('customer_id')->filter()->unique();
        $preferredTypes = $this->getPreferredOrderTypes($customerIds);
        $orderTypeBreakdowns = $this->getOrderTypeBreakdowns($customerIds);
        $paymentMethods = $this->getPaymentMethods($customerIds);
        $loyaltyPoints = $this->getLoyaltyPoints($customerIds);
        $itemsCounts = $this->getItemsCounts($customerIds);
        $customers = Customer::whereIn('id', $customerIds)->get()->keyBy('id');

        $customerData = [];
        foreach ($orderStats as $stat) {
            $customer = $customers->get($stat->customer_id);
            if (!$customer) continue;

            if ($this->search) {
                $search = strtolower($this->search);
                $nameMatch = $customer->name && str_contains(strtolower($customer->name), $search);
                $emailMatch = $customer->email && str_contains(strtolower($customer->email), $search);
                $phoneMatch = $customer->phone && str_contains($customer->phone, $search);
                if (!$nameMatch && !$emailMatch && !$phoneMatch) continue;
            }

            if ($this->minOrders !== '' && (int) $stat->orders_count < (int) $this->minOrders) continue;
            if ($this->minSpend !== '' && (float) $stat->total_revenue < (float) $this->minSpend) continue;

            $customerData[] = [
                'customer' => $customer,
                'orders_count' => (int) $stat->orders_count,
                'total_revenue' => (float) $stat->total_revenue,
                'avg_order_value' => (float) $stat->avg_order_value,
                'first_order_date' => $stat->first_order_date,
                'last_order_date' => $stat->last_order_date,
                'total_discount' => (float) $stat->total_discount,
                'items_count' => $itemsCounts->get($stat->customer_id, 0),
                'preferred_type' => $preferredTypes->get($stat->customer_id),
                'order_type_breakdown' => $orderTypeBreakdowns->get($stat->customer_id, collect()),
                'payment_methods' => $paymentMethods->get($stat->customer_id, collect()),
                'loyalty_points' => $loyaltyPoints->get($stat->customer_id, 0),
            ];
        }

        $badges = $this->computeBadges($customerData, $this->startDate, $this->endDate);

        $favoriteItems = $this->getFavoriteItems($customerIds);

        if ($this->itemFilter) {
            $filteredIds = DB::table('order_items')
                ->select('orders.customer_id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('order_items.menu_item_id', $this->itemFilter)
                ->where('orders.branch_id', branch()->id)
                ->whereNotIn('orders.status', ['draft', 'canceled'])
                ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
                ->distinct()
                ->pluck('customer_id')
                ->toArray();

            $customerData = array_filter($customerData, function ($item) use ($filteredIds) {
                return in_array($item['customer']->id, $filteredIds);
            });
            $customerData = array_values($customerData);
        }

        $tabFiltered = $customerData;
        if ($this->activeTab === 'new') {
            $tabFiltered = array_filter($customerData, function ($item) use ($badges) {
                return in_array('new', $badges[$item['customer']->id] ?? []);
            });
        } elseif ($this->activeTab === 'returning') {
            $tabFiltered = array_filter($customerData, function ($item) use ($badges) {
                $b = $badges[$item['customer']->id] ?? [];
                return in_array('repeat', $b) && !in_array('new', $b);
            });
        } elseif ($this->activeTab === 'at_risk') {
            $tabFiltered = array_filter($customerData, function ($item) use ($badges) {
                return in_array('at_risk', $badges[$item['customer']->id] ?? []);
            });
        } elseif ($this->activeTab === 'vip') {
            $tabFiltered = array_filter($customerData, function ($item) use ($badges) {
                return in_array('vip', $badges[$item['customer']->id] ?? []);
            });
        }

        $tabFiltered = array_values($tabFiltered);

        $sortField = $this->sortField;
        $sortDirection = $this->sortDirection;
        usort($tabFiltered, function ($a, $b) use ($sortField, $sortDirection) {
            $aVal = $a[$sortField] ?? 0;
            $bVal = $b[$sortField] ?? 0;
            if (is_string($aVal)) {
                return $sortDirection === 'asc' ? strcmp($aVal, $bVal) : strcmp($bVal, $aVal);
            }
            return $sortDirection === 'asc' ? $aVal <=> $bVal : $bVal <=> $aVal;
        });

        $perPage = 15;
        $page = request()->get('page', 1);
        $total = count($tabFiltered);
        $sliced = array_slice($tabFiltered, ($page - 1) * $perPage, $perPage);
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $sliced, $total, $perPage, $page,
            ['path' => request()->url()]
        );

        $totalCustomers = count($customerData);
        $totalRevenue = array_sum(array_column($customerData, 'total_revenue'));
        $totalOrders = array_sum(array_column($customerData, 'orders_count'));
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        $previousData = $this->getPreviousPeriodData();
        $prevCustomers = $previousData['customers'] ?? 0;
        $prevRevenue = $previousData['revenue'] ?? 0;
        $prevOrders = $previousData['orders'] ?? 0;

        $topCustomersChart = $this->getTopCustomersChartData();
        $growthChart = $this->getCustomerGrowthChartData();
        $chartsPayload = $this->getChartsPayload($dateTimeData);
        $cohortData = $this->getCohortRetentionData();

        $orderedMenuItems = $this->getOrderedMenuItems();
        $segmentIds = collect($tabFiltered)->pluck('customer.id')->filter()->unique();
        $topItemsData = $this->getTopItemsData($segmentIds->isNotEmpty() ? $segmentIds : null);

        $tabCounts = [
            'all' => count($customerData),
            'new' => count(array_filter($customerData, fn($item) => in_array('new', $badges[$item['customer']->id] ?? []))),
            'returning' => count(array_filter($customerData, function($item) use ($badges) { $b = $badges[$item['customer']->id] ?? []; return in_array('repeat', $b) && !in_array('new', $b); })),
            'at_risk' => count(array_filter($customerData, fn($item) => in_array('at_risk', $badges[$item['customer']->id] ?? []))),
            'vip' => count(array_filter($customerData, fn($item) => in_array('vip', $badges[$item['customer']->id] ?? []))),
        ];

        return view('livewire.reports.customer-report', [
            'customerData' => $paginated,
            'badges' => $badges,
            'totalCustomers' => $totalCustomers,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'avgOrderValue' => $avgOrderValue,
            'prevCustomers' => $prevCustomers,
            'prevRevenue' => $prevRevenue,
            'prevOrders' => $prevOrders,
            'topCustomersChart' => $topCustomersChart,
            'growthChart' => $growthChart,
            'chartsPayload' => $chartsPayload,
            'cohortData' => $cohortData,
            'tabCounts' => $tabCounts,
            'dateTimeData' => $dateTimeData,
            'favoriteItems' => $favoriteItems,
            'orderedMenuItems' => $orderedMenuItems,
            'topItemsData' => $topItemsData,
        ]);
    }
}
