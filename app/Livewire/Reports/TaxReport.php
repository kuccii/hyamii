<?php

namespace App\Livewire\Reports;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Order;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TaxReportExport;
use Nwidart\Modules\Facades\Module;

class TaxReport extends Component
{
    public $dateRangeType;
    public $startDate;
    public $endDate;
    public $startTime = '00:00'; // Default start time
    public $endTime = '23:59';  // Default end time
    public $showDateOrdersModal = false;
    public $selectedDate = null;
    public $selectedDateOrders = [];
    public $selectedDateTotals = [
        'subtotal' => 0,
        'tax' => 0,
        'total' => 0
    ];
    public $activeTab = 'byTaxType';

    // Cache for processed orders data
    private $cachedOrders = null;
    private $cachedOrderDetails = null;

    public function mount()
    {
        abort_if(!in_array('Report', restaurant_modules()), 403);
        abort_if((!user_can('Show Reports')), 403);

        $tz = timezone();

        // Load date range type from cookie
        $this->dateRangeType = request()->cookie('tax_report_date_range_type', 'today');
        $this->setDateRange();
    }

    public function updatedDateRangeType($value)
    {
        cookie()->queue(cookie('tax_report_date_range_type', $value, 60 * 24 * 30)); // 30 days
        $this->setDateRange();
        $this->invalidateCache();
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


    public function updatedStartTime($value)
    {
        $this->invalidateCache();
    }

    public function updatedEndTime($value)
    {
        $this->invalidateCache();
    }

    /**
     * Invalidate cached data when filters change
     */
    private function invalidateCache()
    {
        $this->cachedOrders = null;
        $this->cachedOrderDetails = null;
    }

    public function exportReport($exportType)
    {
        if (!in_array('Export Report', restaurant_modules())) {
            $this->dispatch('showUpgradeLicense');
            return;
        }

        $dateTimeData = $this->prepareDateTimeData();
        $data = [];

        // Use cached data if available, otherwise process fresh
        $orderDetails = $this->getOrderDetails();

        switch ($exportType) {
            case 'byTaxType':
                $data = array_values($this->buildTaxBreakdownFromOrderDetails($orderDetails));
                break;
            case 'byDate':
                $data = array_values($this->buildTaxByDateFromOrderDetails($orderDetails, $dateTimeData['timezone']));
                break;
            case 'byOrder':
                $data = $orderDetails;
                break;
            case 'byRraEbm':
                $rraData = $this->getRraEbmData();
                $data = $rraData['submissions']->toArray();
                break;
        }

        $timeFormat = restaurant()->time_format ?? 'h:i A';
        $formattedStartTime = Carbon::createFromFormat('H:i', $this->startTime)->format($timeFormat);
        $formattedEndTime = Carbon::createFromFormat('H:i', $this->endTime)->format($timeFormat);

        return Excel::download(
            new TaxReportExport(
                $exportType,
                $data,
                $this->startDate,
                $this->endDate,
                $formattedStartTime,
                $formattedEndTime,
                $dateTimeData['timezone']
            ),
            'tax-report-' . $exportType . '-' . now()->format('Y-m-d_His') . '.xlsx'
        );
    }

    /**
     * Build base query for orders with time filtering
     */
    private function buildOrdersQuery($dateTimeData, $withRelations = ['items', 'taxes.tax'])
    {
        $offset = Carbon::now($dateTimeData['timezone'])->format('P');

        $query = Order::with($withRelations)
            ->where('branch_id', branch()->id)
            ->where('status', 'paid')
            ->whereBetween('date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->where(function ($q) use ($dateTimeData, $offset) {
                if ($dateTimeData['startTime'] < $dateTimeData['endTime']) {
                    $q->whereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) BETWEEN ? AND ?", [$offset, $dateTimeData['startTime'], $dateTimeData['endTime']]);
                } else {
                    $q->where(function ($sub) use ($dateTimeData, $offset) {
                        $sub->whereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) >= ?", [$offset, $dateTimeData['startTime']])
                            ->orWhereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) <= ?", [$offset, $dateTimeData['endTime']]);
                    });
                }
            });

        return $query;
    }

    /**
     * Process item-level taxes and return breakdown
     */
    private function processItemTaxes($item, &$orderTaxAmount, &$orderTaxBreakdown, $order = null, $includeItemDetails = false)
    {
        if ($item->tax_amount <= 0) {
            return [];
        }

        $orderTaxAmount += $item->tax_amount;
        $itemTaxDetails = [];
        $taxBreakup = $item->tax_breakup ? json_decode($item->tax_breakup, true) : null;

        if ($taxBreakup && is_array($taxBreakup)) {
            foreach ($taxBreakup as $taxName => $taxInfo) {
                $taxAmount = is_array($taxInfo) ? round(($taxInfo['amount'] ?? 0) * $item->quantity, 2) : 0;
                $taxPercent = is_array($taxInfo) ? ($taxInfo['percent'] ?? 0) : 0;

                if (!isset($orderTaxBreakdown[$taxName])) {
                    $orderTaxBreakdown[$taxName] = [
                        'name' => $taxName,
                        'percent' => $taxPercent,
                        'amount' => 0
                    ];
                }
                $orderTaxBreakdown[$taxName]['amount'] = round($orderTaxBreakdown[$taxName]['amount'] + $taxAmount, 2);

                // For item tax details
                if ($includeItemDetails && $order && (isset($item->menuItem) || isset($item->menuItemVariation))) {
                    $itemTaxDetails[] = [
                        'order_number' => $order->order_number,
                        'order_date' => $order->date_time,
                        'item_name' => $item->menuItem->name ?? ($item->menuItemVariation->name ?? 'N/A'),
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'amount' => $item->amount,
                        'tax_name' => $taxName,
                        'tax_percent' => $taxPercent,
                        'tax_amount' => $taxAmount
                    ];
                }
            }
        } else {
            $taxPercent = $item->tax_percentage ?? 0;
            $taxName = 'Tax (' . number_format($taxPercent, 2) . '%)';

            if (!isset($orderTaxBreakdown[$taxName])) {
                $orderTaxBreakdown[$taxName] = [
                    'name' => $taxName,
                    'percent' => $taxPercent,
                    'amount' => 0
                ];
            }
            $orderTaxBreakdown[$taxName]['amount'] = round($orderTaxBreakdown[$taxName]['amount'] + $item->tax_amount, 2);

            // For item tax details
            if ($includeItemDetails && $order && (isset($item->menuItem) || isset($item->menuItemVariation))) {
                $itemTaxDetails[] = [
                    'order_number' => $order->order_number,
                    'order_date' => $order->date_time,
                    'item_name' => $item->menuItem->name ?? ($item->menuItemVariation->name ?? 'N/A'),
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'amount' => $item->amount,
                    'tax_name' => $taxName,
                    'tax_percent' => $taxPercent,
                    'tax_amount' => $item->tax_amount
                ];
            }
        }

        return $itemTaxDetails;
    }

    /**
     * Process order-level taxes
     */
    private function processOrderTaxes($order, &$orderTaxAmount, &$orderTaxBreakdown)
    {
        foreach ($order->taxes as $orderTax) {
            $tax = $orderTax->tax;

            // Skip if tax relationship is missing
            if (!$tax) {
                continue;
            }

            $taxName = $tax->tax_name;
            $taxPercent = $tax->tax_percent;

            // Calculate net = subtotal - discount
            $subtotal = $order->sub_total ?? 0;
            $discountAmount = $order->discount_amount ?? 0;
            $net = $subtotal - $discountAmount;

            // Use saved tax_base, or old calculation
            $taxBase = $order->tax_base ?? $net;
            $taxAmount = round(($taxPercent / 100) * $taxBase, 2);

            $orderTaxAmount += $taxAmount;

            if (!isset($orderTaxBreakdown[$taxName])) {
                $orderTaxBreakdown[$taxName] = [
                    'name' => $taxName,
                    'percent' => $taxPercent,
                    'amount' => 0
                ];
            }
            $orderTaxBreakdown[$taxName]['amount'] = round($orderTaxBreakdown[$taxName]['amount'] + $taxAmount, 2);
        }
    }

    /**
     * Get processed order details (cached)
     */
    private function getOrderDetails()
    {
        if ($this->cachedOrderDetails !== null) {
            return $this->cachedOrderDetails;
        }

        $dateTimeData = $this->prepareDateTimeData();
        $orders = $this->buildOrdersQuery($dateTimeData, ['items.menuItem', 'items.menuItemVariation', 'taxes.tax'])
            ->orderBy('date_time', 'desc')
            ->get();

        $this->cachedOrders = $orders;
        $orderDetails = [];

        foreach ($orders as $order) {
            $orderTaxAmount = 0;
            $orderTaxBreakdown = [];

            // Process item-level taxes
            foreach ($order->items as $item) {
                $this->processItemTaxes($item, $orderTaxAmount, $orderTaxBreakdown, $order, false);
            }

            // Process order-level taxes
            $this->processOrderTaxes($order, $orderTaxAmount, $orderTaxBreakdown);

            // Fallback to total_tax_amount if no tax calculated
            if ($orderTaxAmount == 0 && isset($order->total_tax_amount) && $order->total_tax_amount > 0) {
                $orderTaxAmount = $order->total_tax_amount;
            }

            // Round order tax amount to 2 decimal places
            $orderTaxAmount = round($orderTaxAmount, 2);

            $orderDetails[] = [
                'order' => $order,
                'tax_amount' => $orderTaxAmount,
                'tax_breakdown' => $orderTaxBreakdown,
                'subtotal' => $order->sub_total ?? 0,
                'total' => $order->total ?? 0
            ];
        }

        $this->cachedOrderDetails = $orderDetails;
        return $orderDetails;
    }

    /**
     * Build tax breakdown from order details
     */
    private function buildTaxBreakdownFromOrderDetails($orderDetails)
    {
        $taxBreakdown = [];
        $taxOrderCounts = []; // Track which orders have been counted for each tax
        $taxItemCounts = []; // Track which items have been counted for each tax

        foreach ($orderDetails as $orderDetail) {
            $order = $orderDetail['order'];
            $orderTaxBreakdown = $orderDetail['tax_breakdown'];

            foreach ($orderTaxBreakdown as $taxName => $taxInfo) {
                if (!isset($taxBreakdown[$taxName])) {
                    $taxBreakdown[$taxName] = [
                        'name' => $taxName,
                        'percent' => $taxInfo['percent'],
                        'total_amount' => 0,
                        'items_count' => 0,
                        'orders_count' => 0
                    ];
                    $taxOrderCounts[$taxName] = [];
                    $taxItemCounts[$taxName] = [];
                }

                $taxBreakdown[$taxName]['total_amount'] = round($taxBreakdown[$taxName]['total_amount'] + $taxInfo['amount'], 2);

                // Count items with this tax - check if tax comes from item-level or order-level
                $isOrderLevelTax = false;
                if (isset($order->taxes)) {
                    foreach ($order->taxes as $orderTax) {
                        if ($orderTax->tax && $orderTax->tax->tax_name === $taxName) {
                            $isOrderLevelTax = true;
                            break;
                        }
                    }
                }

                if (isset($order->items)) {
                    foreach ($order->items as $item) {
                        $itemKey = $order->id . '_' . $item->id;

                        if ($isOrderLevelTax) {
                            // For order-level taxes, count all items in the order
                            if (!in_array($itemKey, $taxItemCounts[$taxName])) {
                                $taxBreakdown[$taxName]['items_count'] += $item->quantity;
                                $taxItemCounts[$taxName][] = $itemKey;
                            }
                        } else {
                            // For item-level taxes, check if this item has this tax in its tax_breakup
                            $taxBreakup = $item->tax_breakup ? json_decode($item->tax_breakup, true) : null;
                            if ($taxBreakup && is_array($taxBreakup) && isset($taxBreakup[$taxName])) {
                                if (!in_array($itemKey, $taxItemCounts[$taxName])) {
                                    $taxBreakdown[$taxName]['items_count'] += $item->quantity;
                                    $taxItemCounts[$taxName][] = $itemKey;
                                }
                            }
                        }
                    }
                }

                // Count orders (each order is counted once per tax type)
                if (!in_array($order->id, $taxOrderCounts[$taxName])) {
                    $taxBreakdown[$taxName]['orders_count'] += 1;
                    $taxOrderCounts[$taxName][] = $order->id;
                }
            }
        }

        return $taxBreakdown;
    }

    /**
     * Build tax by date from order details
     */
    private function buildTaxByDateFromOrderDetails($orderDetails, $timezone)
    {
        $taxByDate = [];

        foreach ($orderDetails as $orderDetail) {
            $order = $orderDetail['order'];
            $orderDate = Carbon::parse($order->date_time, 'UTC')
                ->setTimezone($timezone)
                ->format('Y-m-d');

            if (!isset($taxByDate[$orderDate])) {
                $dateFormat = restaurant()->date_format ?? 'd-m-Y';
                $taxByDate[$orderDate] = [
                    'date' => $orderDate,
                    'formatted_date' => Carbon::parse($order->date_time, 'UTC')
                        ->setTimezone($timezone)
                        ->format($dateFormat),
                    'total_tax' => 0,
                    'total_revenue' => 0,
                    'total_orders' => 0,
                    'total_items' => 0,
                    'tax_breakdown' => []
                ];
            }

            $taxByDate[$orderDate]['total_tax'] = round($taxByDate[$orderDate]['total_tax'] + $orderDetail['tax_amount'], 2);
            $taxByDate[$orderDate]['total_revenue'] = round($taxByDate[$orderDate]['total_revenue'] + $orderDetail['total'], 2);
            $taxByDate[$orderDate]['total_orders'] += 1;
            $taxByDate[$orderDate]['total_items'] += $order->items->sum('quantity');

            foreach ($orderDetail['tax_breakdown'] as $taxName => $taxInfo) {
                if (!isset($taxByDate[$orderDate]['tax_breakdown'][$taxName])) {
                    $taxByDate[$orderDate]['tax_breakdown'][$taxName] = [
                        'name' => $taxName,
                        'percent' => $taxInfo['percent'],
                        'amount' => 0
                    ];
                }
                $taxByDate[$orderDate]['tax_breakdown'][$taxName]['amount'] = round($taxByDate[$orderDate]['tax_breakdown'][$taxName]['amount'] + $taxInfo['amount'], 2);
            }
        }

        krsort($taxByDate);
        return $taxByDate;
    }

    /**
     * Get item tax details from order details
     */
    private function getItemTaxDetailsFromOrderDetails($orderDetails)
    {
        $itemTaxDetails = [];

        foreach ($orderDetails as $orderDetail) {
            $order = $orderDetail['order'];

            foreach ($order->items as $item) {
                if ($item->tax_amount > 0) {
                    $dummyAmount = 0;
                    $dummyBreakdown = [];
                    $itemTaxDetails = array_merge(
                        $itemTaxDetails,
                        $this->processItemTaxes($item, $dummyAmount, $dummyBreakdown, $order, true)
                    );
                }
            }
        }

        return $itemTaxDetails;
    }

    public function openDateOrdersModal($date)
    {
        $this->selectedDate = $date;
        $this->loadDateOrders($date);
        $this->showDateOrdersModal = true;
    }

    public function closeDateOrdersModal()
    {
        $this->showDateOrdersModal = false;
        $this->selectedDate = null;
        $this->selectedDateOrders = [];
        $this->selectedDateTotals = [
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0
        ];
    }

    private function loadDateOrders($date)
    {
        $dateTimeData = $this->prepareDateTimeData();
        $offset = Carbon::now($dateTimeData['timezone'])->format('P');

        // Parse the date and create date range for that specific date
        $dateCarbon = Carbon::createFromFormat('Y-m-d', $date, $dateTimeData['timezone']);
        $startDateTime = $dateCarbon->copy()->setTimeFromTimeString($this->startTime ?: '00:00')->setTimezone('UTC')->toDateTimeString();
        $endDateTime = $dateCarbon->copy()->setTimeFromTimeString($this->endTime ?: '23:59')->setTimezone('UTC')->toDateTimeString();

        // Get orders for this specific date
        $orders = Order::with(['items.menuItem', 'items.menuItemVariation', 'taxes.tax'])
            ->where('branch_id', branch()->id)
            ->where('status', 'paid')
            ->whereBetween('date_time', [$startDateTime, $endDateTime])
            ->where(function ($q) use ($dateTimeData, $offset) {
                if ($dateTimeData['startTime'] < $dateTimeData['endTime']) {
                    $q->whereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) BETWEEN ? AND ?", [$offset, $dateTimeData['startTime'], $dateTimeData['endTime']]);
                } else {
                    $q->where(function ($sub) use ($dateTimeData, $offset) {
                        $sub->whereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) >= ?", [$offset, $dateTimeData['startTime']])
                            ->orWhereRaw("TIME(CONVERT_TZ(date_time, '+00:00', ?)) <= ?", [$offset, $dateTimeData['endTime']]);
                    });
                }
            })
            ->orderBy('date_time', 'desc')
            ->get();

        // Process orders using optimized methods
        $this->selectedDateOrders = [];
        foreach ($orders as $order) {
            $orderTaxAmount = 0;
            $orderTaxBreakdown = [];

            // Process item-level taxes
            foreach ($order->items as $item) {
                $this->processItemTaxes($item, $orderTaxAmount, $orderTaxBreakdown, $order, false);
            }

            // Process order-level taxes
            $this->processOrderTaxes($order, $orderTaxAmount, $orderTaxBreakdown);

            // Fallback to total_tax_amount if no tax calculated
            if ($orderTaxAmount == 0 && isset($order->total_tax_amount) && $order->total_tax_amount > 0) {
                $orderTaxAmount = $order->total_tax_amount;
            }

            // Round order tax amount to 2 decimal places
            $orderTaxAmount = round($orderTaxAmount, 2);

            $this->selectedDateOrders[] = [
                'order' => $order,
                'tax_amount' => $orderTaxAmount,
                'tax_breakdown' => $orderTaxBreakdown,
                'subtotal' => $order->sub_total ?? 0,
                'total' => $order->total ?? 0
            ];
        }

        // Calculate totals efficiently
        $this->selectedDateTotals = [
            'subtotal' => array_sum(array_column($this->selectedDateOrders, 'subtotal')),
            'tax' => array_sum(array_column($this->selectedDateOrders, 'tax_amount')),
            'total' => array_sum(array_column($this->selectedDateOrders, 'total'))
        ];
    }

    /**
     * Get RRA EBM submission data for the date range
     */
    private function getRraEbmData()
    {
        if (!Module::has('RraEbm') || !Module::isEnabled('RraEbm')) {
            return ['submissions' => collect(), 'summary' => []];
        }

        $dateTimeData = $this->prepareDateTimeData();

        // Get submitted orders with receipt signature data
        $submittedOrders = Order::with(['items.menuItem', 'items.menuItemVariation', 'taxes.tax'])
            ->leftJoin('rra_ebm_receipt_signatures', 'orders.id', '=', 'rra_ebm_receipt_signatures.order_id')
            ->select(
                'orders.*',
                'rra_ebm_receipt_signatures.receipt_number',
                'rra_ebm_receipt_signatures.receipt_signature',
                'rra_ebm_receipt_signatures.vsdc_receipt_publish_date',
                'rra_ebm_receipt_signatures.sdc_id',
                'rra_ebm_receipt_signatures.invoice_number'
            )
            ->where('orders.branch_id', branch()->id)
            ->where('orders.status', 'paid')
            ->where('orders.rra_ebm_submitted', true)
            ->whereBetween('orders.date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->orderBy('orders.date_time', 'desc')
            ->get();

        $submissions = [];
        foreach ($submittedOrders as $order) {
            $orderTaxAmount = 0;
            $orderTaxBreakdown = [];

            foreach ($order->items as $item) {
                $this->processItemTaxes($item, $orderTaxAmount, $orderTaxBreakdown, $order, false);
            }

            $this->processOrderTaxes($order, $orderTaxAmount, $orderTaxBreakdown);

            if ($orderTaxAmount == 0 && isset($order->total_tax_amount) && $order->total_tax_amount > 0) {
                $orderTaxAmount = $order->total_tax_amount;
            }

            $submissions[] = [
                'order' => $order,
                'receipt_number' => $order->receipt_number,
                'receipt_signature' => $order->receipt_signature,
                'vsdc_publish_date' => $order->vsdc_receipt_publish_date,
                'sdc_id' => $order->sdc_id,
                'invoice_number' => $order->invoice_number,
                'tax_amount' => round($orderTaxAmount, 2),
                'tax_breakdown' => $orderTaxBreakdown,
                'subtotal' => $order->sub_total ?? 0,
                'total' => $order->total ?? 0,
            ];
        }

        // Summary stats
        $totalSubmittedTax = round(array_sum(array_column($submissions, 'tax_amount')), 2);
        $totalSubmittedRevenue = round(array_sum(array_column($submissions, 'total')), 2);
        $totalSubmittedCount = count($submissions);

        // Count pending/failed in same date range
        $pendingCount = Order::where('branch_id', branch()->id)
            ->where('status', 'paid')
            ->where('rra_ebm_submitted', false)
            ->whereBetween('date_time', [$dateTimeData['startDateTime'], $dateTimeData['endDateTime']])
            ->count();

        $summary = [
            'total_submitted' => $totalSubmittedCount,
            'total_tax' => $totalSubmittedTax,
            'total_revenue' => $totalSubmittedRevenue,
            'pending_count' => $pendingCount,
        ];

        return ['submissions' => collect($submissions), 'summary' => $summary];
    }

    /**
     * Check if RRA EBM module is available
     */
    private function isRraEbmEnabled(): bool
    {
        return Module::has('RraEbm') && Module::isEnabled('RraEbm');
    }

    private function prepareDateTimeData()
    {
        $timezone = timezone();
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';

        // Ensure time is in H:i format
        $startTimeStr = $this->startTime ?: '00:00';
        $endTimeStr = $this->endTime ?: '23:59';

        // Parse dates and times
        $startDateCarbon = Carbon::createFromFormat($dateFormat, $this->startDate, $timezone);
        $endDateCarbon = Carbon::createFromFormat($dateFormat, $this->endDate, $timezone);

        // Set times on the dates
        $startDateTime = $startDateCarbon->copy()->setTimeFromTimeString($startTimeStr)->setTimezone('UTC')->toDateTimeString();
        $endDateTime = $endDateCarbon->copy()->setTimeFromTimeString($endTimeStr)->setTimezone('UTC')->toDateTimeString();

        // Keep times in restaurant timezone for SQL TIME() comparison (we'll convert datetime in SQL)
        $startTime = $startTimeStr;
        $endTime = $endTimeStr;

        return compact('timezone', 'startDateTime', 'endDateTime', 'startTime', 'endTime');
    }

    public function render()
    {
        $dateTimeData = $this->prepareDateTimeData();
        $tz = timezone();

        // Get processed order details (this caches the result)
        $orderDetails = $this->getOrderDetails();
        $orders = $this->cachedOrders;

        // Get today's orders for today's summary
        $todayStart = Carbon::now($tz)->startOfDay()->setTimezone('UTC')->toDateTimeString();
        $todayEnd = Carbon::now($tz)->endOfDay()->setTimezone('UTC')->toDateTimeString();

        $todayOrders = Order::with(['items', 'taxes.tax'])
            ->where('branch_id', branch()->id)
            ->where('status', 'paid')
            ->whereBetween('date_time', [$todayStart, $todayEnd])
            ->get();

        // Get all taxes for this branch
        $allTaxes = Tax::withoutGlobalScopes()->where('branch_id', branch()->id)->get();

        // Build tax breakdown from order details
        $taxBreakdown = $this->buildTaxBreakdownFromOrderDetails($orderDetails);

        // Get item tax details
        $itemTaxDetails = $this->getItemTaxDetailsFromOrderDetails($orderDetails);

        // Calculate overall totals efficiently - sum from breakdown to ensure accuracy
        $totalTax = 0;
        foreach ($taxBreakdown as $tax) {
            $totalTax += $tax['total_amount'];
        }
        $totalTax = round($totalTax, 2);
        $totalAmount = round(array_sum(array_column($orderDetails, 'total')), 2);
        $totalOrders = count($orderDetails);
        $totalItems = $orders->sum(function($order) {
            return $order->items->sum('quantity');
        });

        // Calculate today's tax summary
        $todayTaxTotal = 0;
        foreach ($todayOrders as $todayOrder) {
            $orderTax = $todayOrder->items->sum('tax_amount') ?? 0;

            foreach ($todayOrder->taxes as $orderTaxRelation) {
                $tax = $orderTaxRelation->tax;

                // Skip if tax relationship is missing
                if (!$tax) {
                    continue;
                }

                $subtotal = $todayOrder->sub_total ?? 0;
                $discountAmount = $todayOrder->discount_amount ?? 0;
                $taxableAmount = $subtotal - $discountAmount;
                $orderTax += round(($tax->tax_percent / 100) * $taxableAmount, 2);
            }

            if ($orderTax == 0 && isset($todayOrder->total_tax_amount) && $todayOrder->total_tax_amount > 0) {
                $orderTax = $todayOrder->total_tax_amount;
            }

            $todayTaxTotal = round($todayTaxTotal + $orderTax, 2);
        }
        $todayOrdersCount = $todayOrders->count();
        $todayRevenue = $todayOrders->sum('total');

        // Build tax by date from order details
        $taxByDate = $this->buildTaxByDateFromOrderDetails($orderDetails, $dateTimeData['timezone']);

        // Get RRA EBM data
        $rraEbmEnabled = $this->isRraEbmEnabled();
        $rraData = $rraEbmEnabled ? $this->getRraEbmData() : ['submissions' => collect(), 'summary' => []];

        return view('livewire.reports.tax-report', [
            'orders' => $orders,
            'orderDetails' => $orderDetails,
            'itemTaxDetails' => $itemTaxDetails,
            'taxBreakdown' => $taxBreakdown,
            'totalTax' => $totalTax,
            'totalAmount' => $totalAmount,
            'totalOrders' => $totalOrders,
            'totalItems' => $totalItems,
            'todayTaxTotal' => $todayTaxTotal,
            'todayOrdersCount' => $todayOrdersCount,
            'todayRevenue' => $todayRevenue,
            'allTaxes' => $allTaxes,
            'taxByDate' => $taxByDate,
            'rraEbmEnabled' => $rraEbmEnabled,
            'rraSubmissions' => $rraData['submissions'],
            'rraSummary' => $rraData['summary'],
        ]);
    }

}

