<div>
    @php
        $timeFormat = restaurant()->time_format ?? 'h:i A';
        $formattedStartTime = \Carbon\Carbon::createFromFormat('H:i', $startTime)->format($timeFormat);
        $formattedEndTime = \Carbon\Carbon::createFromFormat('H:i', $endTime)->format($timeFormat);
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';

        $prevAvgOrderValue = $prevOrders > 0 ? $prevRevenue / $prevOrders : 0;
        $customerChange = $prevCustomers > 0 ? round(($totalCustomers - $prevCustomers) / $prevCustomers * 100, 1) : 0;
        $revenueChange = $prevRevenue > 0 ? round(($totalRevenue - $prevRevenue) / $prevRevenue * 100, 1) : 0;
        $aovChange = $prevAvgOrderValue > 0 ? round(($avgOrderValue - $prevAvgOrderValue) / $prevAvgOrderValue * 100, 1) : 0;
        $orderChange = $prevOrders > 0 ? round(($totalOrders - $prevOrders) / $prevOrders * 100, 1) : 0;

        $currencyId = restaurant()->currency_id;
    @endphp

    {{-- Header --}}
    <div class="p-4 bg-white dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Customer Report</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    <strong>
                        {{ $startDate === $endDate
                            ? __('modules.report.salesDataFor') . " $startDate, " . __('modules.report.timePeriod') . " $formattedStartTime - $formattedEndTime"
                            : __('modules.report.salesDataFrom') . " $startDate " . __('app.to') . " $endDate, " . __('modules.report.timePeriodEachDay') . " $formattedStartTime - $formattedEndTime" }}
                    </strong>
                </p>
            </div>
            <a href="javascript:;" wire:click='exportReport'
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414A2 2 0 0 0 15.414 6L12 2.586A2 2 0 0 0 10.586 2zm5 6a1 1 0 1 0-2 0v3.586l-1.293-1.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0-1.414-1.414L11 11.586z" clip-rule="evenodd"/></svg>
                @lang('app.export')
            </a>
        </div>

        {{-- Summary Cards with Period Comparison --}}
        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Total Customers --}}
            <div class="p-4 bg-skin-base/10 rounded-xl shadow-sm border border-skin-base/30">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-skin-base">Total Customers</h3>
                    <div class="p-2 bg-skin-base/10 rounded-lg">
                        <svg class="w-4 h-4 text-skin-base" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-skin-base">{{ $totalCustomers }}</p>
                @if($prevCustomers > 0)
                    <p class="mt-1 text-xs flex items-center gap-1 {{ $customerChange >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        @if($customerChange >= 0)
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        @else
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        @endif
                        {{ abs($customerChange) }}% vs previous period
                    </p>
                @endif
            </div>

            {{-- Total Revenue --}}
            <div class="p-4 bg-emerald-50 rounded-xl shadow-sm border border-emerald-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-emerald-600">Total Revenue</h3>
                    <div class="p-2 bg-emerald-100 rounded-lg">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-emerald-600">{{ currency_format($totalRevenue, $currencyId) }}</p>
                @if($prevRevenue > 0)
                    <p class="mt-1 text-xs flex items-center gap-1 {{ $revenueChange >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        @if($revenueChange >= 0)
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        @else
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        @endif
                        {{ abs($revenueChange) }}% vs previous period
                    </p>
                @endif
            </div>

            {{-- Average Order Value --}}
            <div class="p-4 bg-blue-50 rounded-xl shadow-sm border border-blue-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-blue-600">Average Order Value</h3>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-blue-600">{{ currency_format($avgOrderValue, $currencyId) }}</p>
                @if($prevAvgOrderValue > 0)
                    <p class="mt-1 text-xs flex items-center gap-1 {{ $aovChange >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        @if($aovChange >= 0)
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        @else
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        @endif
                        {{ abs($aovChange) }}% vs previous period
                    </p>
                @endif
            </div>

            {{-- Total Orders --}}
            <div class="p-4 bg-amber-50 rounded-xl shadow-sm border border-amber-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-amber-600">Total Orders</h3>
                    <div class="p-2 bg-amber-100 rounded-lg">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-amber-600">{{ $totalOrders }}</p>
                @if($prevOrders > 0)
                    <p class="mt-1 text-xs flex items-center gap-1 {{ $orderChange >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        @if($orderChange >= 0)
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        @else
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        @endif
                        {{ abs($orderChange) }}% vs previous period
                    </p>
                @endif
            </div>
        </div>

        {{-- Charts Row --}}
        @php
            $hasTopChart = !empty($chartsPayload['topCustomers']['categories'] ?? []);
            $hasGrowthChart = !empty($chartsPayload['customerGrowth']['labels'] ?? []);
        @endphp
        <script type="application/json" id="customer-report-chart-data" data-chart-hash="{{ $chartsPayload['hash'] ?? '' }}">{!! json_encode($chartsPayload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Top 10 Customers by Revenue</h3>
                <div class="relative w-full" style="height:280px">
                    <div id="top-customers-chart" wire:ignore class="w-full h-full"></div>
                    @if(!$hasTopChart)
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 pointer-events-none">
                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            <span class="text-sm">No customer revenue data for this period</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Customer Growth (New Customers)</h3>
                <div class="relative w-full" style="height:280px">
                    <div id="customer-growth-chart" wire:ignore class="w-full h-full"></div>
                    @if(!$hasGrowthChart)
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 pointer-events-none">
                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <span class="text-sm">No customer growth data for this period</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="flex flex-wrap justify-between items-center gap-4 p-4 bg-gray-50 rounded-lg dark:bg-gray-700 mb-4">
            <div class="lg:flex items-center w-full">
                <form class="w-full" action="#" method="GET">
                    <div class="lg:flex gap-2 items-center w-full">
                        <div class="flex items-center gap-2 mb-2 lg:mb-0">
                            <x-select id="dateRangeType" class="block w-full sm:w-fit" wire:model.defer="dateRangeType" wire:change="setDateRange">
                                <option value="today">@lang('app.today')</option>
                                <option value="currentWeek">@lang('app.currentWeek')</option>
                                <option value="lastWeek">@lang('app.lastWeek')</option>
                                <option value="last7Days">@lang('app.last7Days')</option>
                                <option value="currentMonth">@lang('app.currentMonth')</option>
                                <option value="lastMonth">@lang('app.lastMonth')</option>
                                <option value="currentYear">@lang('app.currentYear')</option>
                                <option value="lastYear">@lang('app.lastYear')</option>
                            </x-select>
                            <div class="flex items-center gap-1">
                                <x-datepicker wire:model.change='startDate' placeholder="@lang('app.selectStartDate')" />
                                <span class="mx-1 text-gray-500 dark:text-gray-100">@lang('app.to')</span>
                                <x-datepicker wire:model.live='endDate' placeholder="@lang('app.selectEndDate')" />
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mb-2 lg:mb-0 lg:ms-2">
                            <div class="w-full max-w-[12rem]">
                                <label for="start-time" class="sr-only">@lang('modules.reservation.timeStart'):</label>
                                <div x-on:input.debounce.500ms="$wire.set('startTime', $event.detail)">
                                    <x-time-picker value="{{ $startTime }}" />
                                </div>
                            </div>
                            <span class="text-gray-500 dark:text-gray-100">@lang('app.to')</span>
                            <div class="w-full max-w-[12rem]">
                                <label for="end-time" class="sr-only">@lang('modules.reservation.timeEnd'):</label>
                                <div x-on:input.debounce.500ms="$wire.set('endTime', $event.detail)">
                                    <x-time-picker value="{{ $endTime }}" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 lg:ms-2 lg:flex-1">
                            <div class="relative w-full max-w-xs">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <x-input type="text" wire:model.live.debounce.500ms="search" placeholder="Search customers..." class="pl-10" />
                            </div>
                            <x-select wire:model.live="orderTypeFilter" class="w-full sm:w-40">
                                <option value="">All Types</option>
                                <option value="dine_in">Dine In</option>
                                <option value="delivery">Delivery</option>
                                <option value="pickup">Pickup</option>
                            </x-select>
                            <x-select wire:model.live="itemFilter" class="w-full sm:w-48">
                                <option value="">All Items</option>
                                @foreach($orderedMenuItems as $menuItem)
                                    <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <div class="flex flex-wrap gap-2 mb-4">
            @php
                $tabs = [
                    'all' => 'All',
                    'new' => 'New',
                    'returning' => 'Returning',
                    'at_risk' => 'At-Risk',
                    'vip' => 'VIP',
                ];
            @endphp
            @foreach($tabs as $tabKey => $tabLabel)
                <button wire:click="$set('activeTab', '{{ $tabKey }}')"
                    class="px-3 py-1.5 text-xs font-medium rounded-full transition-colors
                        {{ $activeTab === $tabKey
                            ? 'bg-skin-base text-white shadow-sm'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                    {{ $tabLabel }}
                    <span class="ml-1 {{ $activeTab === $tabKey ? 'opacity-80' : 'text-gray-400' }}">({{ $tabCounts[$tabKey] ?? 0 }})</span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- Customer Data Table --}}
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        @if(count($customerData) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Customer</th>
                        <th scope="col" class="px-4 py-3 text-center">Items</th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('orders_count')">
                            <div class="flex items-center gap-1 justify-end">
                                Orders
                                @if($sortField === 'orders_count')
                                    <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('total_revenue')">
                            <div class="flex items-center gap-1 justify-end">
                                Revenue
                                @if($sortField === 'total_revenue')
                                    <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('avg_order_value')">
                            <div class="flex items-center gap-1 justify-end">
                                Avg Value
                                @if($sortField === 'avg_order_value')
                                    <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-right">Discount</th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('last_order_date')">
                            <div class="flex items-center gap-1">
                                Last Order
                                @if($sortField === 'last_order_date')
                                    <svg class="w-3 h-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">Days Since</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customerData as $item)
                        @php
                            $cid = $item['customer']->id;
                            $itemBadges = $badges[$cid] ?? [];
                            $daysSince = $item['last_order_date']
                                ? \Carbon\Carbon::parse($item['last_order_date'])->diffInDays(\Carbon\Carbon::now())
                                : null;
                        @endphp
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-skin-base/10 flex items-center justify-center text-skin-base font-semibold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($item['customer']->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        @php
                                            $favItem = $favoriteItems->get($cid);
                                            $topItemName = $favItem ? $favItem[0]['name'] ?? null : null;
                                            $topItemQty = $favItem ? $favItem[0]['qty'] ?? 0 : 0;
                                        @endphp
                                        <p class="font-medium text-gray-900 dark:text-white truncate max-w-[160px]"
                                            @if($topItemName)
                                                title="Top item: {{ $topItemName }} ×{{ $topItemQty }}"
                                            @endif
                                        >{{ $item['customer']->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500 truncate max-w-[160px]">{{ $item['customer']->email ?? $item['customer']->phone ?? '' }}</p>
                                    </div>
                                </div>
                                {{-- Badges --}}
                                @if(count($itemBadges) > 0)
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach($itemBadges as $badge)
                                            @php
                                                $badgeStyles = [
                                                    'vip' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                    'new' => 'bg-green-100 text-green-700 border-green-200',
                                                    'repeat' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'at_risk' => 'bg-red-100 text-red-700 border-red-200',
                                                ];
                                            @endphp
                                            <span class="px-1.5 py-0.5 text-[10px] font-medium rounded border {{ $badgeStyles[$badge] ?? 'bg-gray-100 text-gray-600' }}">
                                                {{ ucfirst(str_replace('_', ' ', $badge)) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                {{-- Top Items --}}
                                @php
                                    $favItems = $favoriteItems->get($cid, collect())->take(2);
                                @endphp
                                @if($favItems->isNotEmpty())
                                    <div class="flex flex-wrap gap-x-2 mt-1 text-[10px] text-gray-500 dark:text-gray-400">
                                        @foreach($favItems as $fi)
                                            <span>{{ $fi['name'] }} <strong class="text-gray-700 dark:text-gray-300">×{{ $fi['qty'] }}</strong></span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $item['items_count'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $item['orders_count'] }}</span>
                            </td>
                            <td class="px-4 py-3 text-right font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ currency_format($item['total_revenue'], $currencyId) }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                {{ currency_format($item['avg_order_value'], $currencyId) }}
                            </td>
                            <td class="px-4 py-3 text-right text-xs">
                                @if($item['total_discount'] > 0)
                                    <span class="text-red-600 dark:text-red-400">{{ currency_format($item['total_discount'], $currencyId) }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs whitespace-nowrap">
                                @if($item['last_order_date'])
                                    {{ \Carbon\Carbon::parse($item['last_order_date'])->setTimezone(timezone())->format($dateFormat) }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($daysSince !== null)
                                    <span class="text-xs {{ $daysSince > 30 ? 'text-red-600 font-medium' : 'text-gray-600 dark:text-gray-400' }}">{{ $daysSince }}d</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <button wire:click="openCustomerProfile({{ $item['customer']->id }})"
                                    class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-skin-base bg-skin-base/10 rounded-lg hover:bg-skin-base/20 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    360°
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                @lang('app.noDataFound')
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $customerData->links() }}
        </div>
        @else
        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p>@lang('app.noDataFound')</p>
        </div>
        @endif
    </div>

    {{-- Customer 360 Modal --}}
    <x-dialog-modal wire:model.live="showCustomerProfileModal" maxWidth="4xl" maxHeight="full">
        <x-slot name="title">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-skin-base" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Customer 360° — {{ $selectedCustomerName }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            @if($selectedCustomerId)
                {{-- Lifetime Stats Summary --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                    <div class="p-3 bg-skin-base/5 rounded-lg border border-skin-base/20 text-center">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Lifetime Orders</p>
                        <p class="text-xl font-bold text-skin-base">{{ $selectedCustomerLifetimeStats['all_orders'] ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-lg border border-emerald-100 text-center">
                        <p class="text-xs text-gray-500">Lifetime Revenue</p>
                        <p class="text-xl font-bold text-emerald-600">{{ currency_format($selectedCustomerLifetimeStats['all_revenue'] ?? 0, $currencyId) }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg border border-blue-100 text-center">
                        <p class="text-xs text-gray-500">First Order Ever</p>
                        <p class="text-sm font-bold text-blue-600">
                            @if($selectedCustomerLifetimeStats['first_order_ever'])
                                {{ \Carbon\Carbon::parse($selectedCustomerLifetimeStats['first_order_ever'])->setTimezone(timezone())->format($dateFormat) }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-lg border border-amber-100 text-center">
                        <p class="text-xs text-gray-500">Period Total</p>
                        <p class="text-xl font-bold text-amber-600">{{ currency_format($selectedCustomerTotals['total_revenue'] ?? 0, $currencyId) }}</p>
                    </div>
                </div>

                {{-- Favorite Items Summary --}}
                @php
                    $favSummary = [];
                    foreach ($selectedCustomerOrders as $order) {
                        foreach ($order->items as $item) {
                            $name = $item->menuItem?->item_name ?? $item->menuItem?->name ?? 'Item #'.$item->menu_item_id;
                            if (!isset($favSummary[$name])) {
                                $favSummary[$name] = 0;
                            }
                            $favSummary[$name] += $item->quantity;
                        }
                    }
                    arsort($favSummary);
                    $favSummary = array_slice($favSummary, 0, 3);
                @endphp
                @if(count($favSummary) > 0)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1.5 font-medium">Favorite Items</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($favSummary as $itemName => $qty)
                                <span class="px-2 py-1 text-[10px] font-medium bg-skin-base/5 text-skin-base rounded-full border border-skin-base/15">
                                    {{ $itemName }} <strong class="ml-0.5">×{{ $qty }}</strong>
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Period Orders --}}
                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Orders (selected period)</h4>
                @if(count($selectedCustomerOrders) > 0)
                <div class="max-h-[50vh] overflow-y-auto mb-4 space-y-3">
                    @foreach($selectedCustomerOrders as $order)
                        <div x-data="{ showItems: false }" wire:key="order-wrap-{{ $order->id }}">
                            <x-order.order-card :order="$order" />
                            <button @click="showItems = !showItems"
                                class="mt-1 w-full flex items-center justify-between px-3 py-1.5 text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <span class="font-medium">
                                    <span x-show="!showItems">Show Items</span>
                                    <span x-show="showItems">Hide Items</span>
                                    ({{ $order->items->count() }})
                                </span>
                                <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': showItems }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="showItems" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-100 dark:border-gray-600/50 divide-y divide-gray-100 dark:divide-gray-600/50">
                                @foreach($order->items as $item)
                                    <div class="px-3 py-2">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs font-medium text-gray-900 dark:text-white truncate">{{ $item->menuItem?->item_name ?? $item->menuItem?->name ?? 'Item #'.$item->menu_item_id }}</p>
                                                @if($item->menuItemVariation)
                                                    <p class="text-[10px] text-gray-500 dark:text-gray-400">{{ $item->menuItemVariation->variation }}</p>
                                                @endif
                                                @if($item->note)
                                                    <p class="text-[10px] text-gray-400 italic mt-0.5">Note: {{ $item->note }}</p>
                                                @endif
                                                @if($item->modifierOptions->count() > 0)
                                                    <div class="flex flex-wrap gap-1 mt-1">
                                                        @foreach($item->modifierOptions as $mod)
                                                            <span class="px-1 py-0.5 text-[9px] bg-skin-base/5 text-skin-base rounded border border-skin-base/10">
                                                                {{ $mod->pivot->modifier_option_name ?? $mod->name ?? '+' }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->quantity }} × {{ currency_format($item->price, $currencyId) }}</p>
                                                <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium">{{ currency_format($item->amount, $currencyId) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <p class="text-xs text-gray-400 mb-4">No orders in the selected period.</p>
                @endif

                {{-- Reservations --}}
                @if(count($selectedCustomerReservations) > 0)
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Recent Reservations</h4>
                    <div class="overflow-x-auto max-h-[20vh] mb-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                                <tr>
                                    <th class="px-3 py-2">Date</th>
                                    <th class="px-3 py-2">Guests</th>
                                    <th class="px-3 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedCustomerReservations as $res)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-3 py-2 text-xs">{{ \Carbon\Carbon::parse($res->reservation_date_time ?? $res->created_at)->setTimezone(timezone())->format($dateFormat) }}</td>
                                        <td class="px-3 py-2 text-xs">{{ $res->guest_number ?? '-' }}</td>
                                        <td class="px-3 py-2">
                                            <span class="px-1.5 py-0.5 text-[10px] rounded-full bg-blue-100 text-blue-700">{{ ucfirst($res->reservation_status ?? 'confirmed') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- Addresses --}}
                @if(count($selectedCustomerAddresses) > 0)
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Saved Addresses</h4>
                    <div class="space-y-2 mb-4">
                        @foreach($selectedCustomerAddresses as $addr)
                            <div class="p-2 bg-gray-50 dark:bg-gray-700 rounded text-xs">
                                <p class="text-gray-900 dark:text-white">{{ $addr['address'] ?? $addr['street'] ?? '' }}</p>
                                @if(!empty($addr['city']) || !empty($addr['state']))
                                    <p class="text-gray-500">{{ $addr['city'] ?? '' }}{{ !empty($addr['city']) && !empty($addr['state']) ? ', ' : '' }}{{ $addr['state'] ?? '' }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <p>Select a customer to view details.</p>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeCustomerProfile" wire:loading.attr="disabled">
                {{ __('app.close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Cohort Retention Table --}}
    @if(count($cohortData) > 0)
    @php
        $maxMonths = 0;
        foreach ($cohortData as $cohort) {
            $cnt = count($cohort['months']);
            if ($cnt > $maxMonths) $maxMonths = $cnt;
        }
    @endphp
    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Cohort Retention (Monthly)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-3 py-2">Cohort</th>
                        <th class="px-3 py-2 text-right">Size</th>
                        <th class="px-3 py-2 text-right">Month 0</th>
                        @for($m = 1; $m <= $maxMonths; $m++)
                            <th class="px-3 py-2 text-right">Month {{ $m }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($cohortData as $cohort)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-3 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $cohort['cohort'] }}</td>
                            <td class="px-3 py-2 text-right font-semibold">{{ $cohort['size'] }}</td>
                            <td class="px-3 py-2 text-right font-semibold text-skin-base">100%</td>
                            @for($m = 1; $m <= $maxMonths; $m++)
                                @php
                                    $retained = $cohort['months']['month_' . $m] ?? 0;
                                    $pct = $cohort['size'] > 0 ? round($retained / $cohort['size'] * 100, 1) : 0;
                                @endphp
                                <td class="px-3 py-2 text-right {{ $pct > 0 ? 'text-skin-base font-medium' : 'text-gray-400' }}">
                                    {{ $pct > 0 ? $pct . '%' : '-' }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Top Items Table --}}
    @if(count($topItemsData) > 0)
    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Top Items This Period</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-3 py-2">Item</th>
                        <th class="px-3 py-2">Category</th>
                        <th class="px-3 py-2 text-right">Qty Sold</th>
                        <th class="px-3 py-2 text-right">Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topItemsData as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">{{ $item->item_name ?? $item['item_name'] ?? $item->name ?? '' }}</td>
                            <td class="px-3 py-2">{{ $item->category_name ?? $item['category_name'] ?? '-' }}</td>
                            <td class="px-3 py-2 text-right font-semibold">{{ $item->qty_sold ?? $item['qty_sold'] ?? 0 }}</td>
                            <td class="px-3 py-2 text-right font-semibold text-emerald-600 dark:text-emerald-400">{{ currency_format($item->total_rev ?? $item['total_rev'] ?? 0, $currencyId) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

@once
    @push('scripts')
    <script>
        (function () {
            var currencySymbol = @json(currency());
            var chartInitTimer = null;
            var lastAppliedChartHash = null;

            function readCustomerReportChartData() {
                var el = document.getElementById('customer-report-chart-data');
                if (!el || !el.textContent) {
                    return null;
                }

                try {
                    return JSON.parse(el.textContent);
                } catch (e) {
                    console.warn('[CustomerReport] Invalid chart payload', e);
                    return null;
                }
            }

            function readChartHash() {
                var el = document.getElementById('customer-report-chart-data');
                return el ? (el.getAttribute('data-chart-hash') || '') : '';
            }

            function getTopChartOptions(chartData) {
                var colors = document.documentElement.classList.contains('dark')
                    ? { borderColor: '#374151', labelColor: '#9CA3AF' }
                    : { borderColor: '#F3F4F6', labelColor: '#6B7280' };
                var teal = '#002522';
                var symbol = chartData.currencySymbol || currencySymbol;

                return {
                    chart: {
                        type: 'bar',
                        height: 280,
                        fontFamily: 'Inter, sans-serif',
                        foreColor: colors.labelColor,
                        toolbar: { show: false },
                        animations: { enabled: false },
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: false,
                            columnWidth: '70%',
                            dataLabels: { position: 'top' }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'vertical',
                            shadeIntensity: 0.4,
                            gradientToColors: [teal],
                            inverseColors: false,
                            opacityFrom: 0.9,
                            opacityTo: 0.3
                        }
                    },
                    colors: [teal],
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) { return symbol + val.toFixed(0); },
                        offsetY: -20,
                        style: { fontSize: '9px', fontFamily: 'Inter, sans-serif', colors: [colors.labelColor] }
                    },
                    stroke: { show: false },
                    grid: {
                        show: true,
                        borderColor: colors.borderColor,
                        strokeDashArray: 1,
                        padding: { left: 10, right: 10, top: 20, bottom: 10 }
                    },
                    series: [{ name: 'Revenue', data: chartData.topCustomers.series }],
                    xaxis: {
                        categories: chartData.topCustomers.categories,
                        labels: {
                            style: { colors: colors.labelColor, fontSize: '9px', fontWeight: 400 },
                            trim: true,
                            maxHeight: 60
                        },
                        axisBorder: { color: colors.borderColor },
                        axisTicks: { color: colors.borderColor }
                    },
                    yaxis: {
                        labels: {
                            style: { colors: [colors.labelColor], fontSize: '9px' },
                            formatter: function (val) { return symbol + val.toFixed(0); }
                        }
                    },
                    legend: { show: false },
                    tooltip: {
                        style: { fontSize: '11px', fontFamily: 'Inter, sans-serif' },
                        y: { formatter: function (val) { return symbol + val.toFixed(2); } }
                    },
                    responsive: [{
                        breakpoint: 1024,
                        options: { xaxis: { labels: { show: false } } }
                    }]
                };
            }

            function getGrowthChartOptions(chartData) {
                var colors = document.documentElement.classList.contains('dark')
                    ? { borderColor: '#374151', labelColor: '#9CA3AF', opacityFrom: 0, opacityTo: 0.15 }
                    : { borderColor: '#F3F4F6', labelColor: '#6B7280', opacityFrom: 0.45, opacityTo: 0 };

                return {
                    chart: {
                        height: 280,
                        type: 'area',
                        fontFamily: 'Inter, sans-serif',
                        foreColor: colors.labelColor,
                        toolbar: { show: false },
                        animations: { enabled: false },
                    },
                    fill: {
                        type: 'gradient',
                        gradient: { enabled: true, opacityFrom: colors.opacityFrom, opacityTo: colors.opacityTo }
                    },
                    stroke: { width: 2, curve: 'smooth' },
                    dataLabels: { enabled: false },
                    tooltip: { style: { fontSize: '11px', fontFamily: 'Inter, sans-serif' } },
                    grid: {
                        show: true,
                        borderColor: colors.borderColor,
                        strokeDashArray: 1,
                        padding: { left: 35, bottom: 15 }
                    },
                    series: [{
                        name: 'New Customers',
                        data: chartData.customerGrowth.data,
                        color: '#A33B38'
                    }],
                    markers: { size: 4, strokeColors: '#ffffff', hover: { size: undefined, sizeOffset: 3 } },
                    xaxis: {
                        categories: chartData.customerGrowth.labels,
                        tickAmount: Math.min(8, chartData.customerGrowth.labels.length),
                        labels: {
                            style: { colors: [colors.labelColor], fontSize: '9px', fontWeight: 400 },
                            rotate: -35,
                            hideOverlappingLabels: true,
                        },
                        axisBorder: { color: colors.borderColor },
                        axisTicks: { color: colors.borderColor },
                        crosshairs: { show: true, position: 'back', stroke: { color: colors.borderColor, width: 1, dashArray: 10 } }
                    },
                    yaxis: {
                        labels: {
                            style: { colors: [colors.labelColor], fontSize: '9px' },
                            formatter: function (val) { return Math.round(val); }
                        }
                    },
                    legend: { fontSize: '11px', fontWeight: 500, fontFamily: 'Inter, sans-serif', labels: { colors: [colors.labelColor] }, itemMargin: { horizontal: 10 } },
                    responsive: [{
                        breakpoint: 1024,
                        options: { xaxis: { labels: { show: false } } }
                    }]
                };
            }

            function destroyChart(instance) {
                if (instance) {
                    try {
                        instance.destroy();
                    } catch (e) {
                        /* ignore */
                    }
                }
            }

            function renderCustomerReportCharts(force) {
                if (!window.ApexCharts) {
                    return;
                }

                var chartHash = readChartHash();
                if (!document.getElementById('customer-report-chart-data')) {
                    return;
                }

                if (!force && chartHash && chartHash === lastAppliedChartHash) {
                    return;
                }

                var chartData = readCustomerReportChartData();
                if (!chartData) {
                    return;
                }

                lastAppliedChartHash = chartHash;

                try {
                    var topEl = document.getElementById('top-customers-chart');
                    if (topEl) {
                        if (chartData.topCustomers.categories.length > 0) {
                            if (window.topChartInstance) {
                                window.topChartInstance.updateOptions(getTopChartOptions(chartData), true, true);
                            } else {
                                window.topChartInstance = new ApexCharts(topEl, getTopChartOptions(chartData));
                                window.topChartInstance.render();
                            }
                        } else {
                            destroyChart(window.topChartInstance);
                            window.topChartInstance = null;
                        }
                    }

                    var growthEl = document.getElementById('customer-growth-chart');
                    if (growthEl) {
                        if (chartData.customerGrowth.labels.length > 0) {
                            if (window.growthChartInstance) {
                                window.growthChartInstance.updateOptions(getGrowthChartOptions(chartData), true, true);
                            } else {
                                window.growthChartInstance = new ApexCharts(growthEl, getGrowthChartOptions(chartData));
                                window.growthChartInstance.render();
                            }
                        } else {
                            destroyChart(window.growthChartInstance);
                            window.growthChartInstance = null;
                        }
                    }
                } catch (e) {
                    console.warn('[CustomerReport] Chart init error:', e);
                }
            }

            window.initCustomerReportCharts = function (force) {
                clearTimeout(chartInitTimer);
                chartInitTimer = setTimeout(function () {
                    renderCustomerReportCharts(!!force);
                }, 120);
            };

            window.teardownCustomerReportCharts = function () {
                clearTimeout(chartInitTimer);
                destroyChart(window.topChartInstance);
                destroyChart(window.growthChartInstance);
                window.topChartInstance = null;
                window.growthChartInstance = null;
                lastAppliedChartHash = null;
            };

            document.addEventListener('DOMContentLoaded', function () {
                window.initCustomerReportCharts(true);
            });

            document.addEventListener('livewire:navigated', function () {
                lastAppliedChartHash = null;
                window.initCustomerReportCharts(true);
            });

            document.addEventListener('dark-mode', function () {
                var chartData = readCustomerReportChartData();
                if (!chartData) {
                    return;
                }

                try {
                    if (window.topChartInstance && chartData.topCustomers.categories.length > 0) {
                        window.topChartInstance.updateOptions(getTopChartOptions(chartData), false, true);
                    }
                    if (window.growthChartInstance && chartData.customerGrowth.labels.length > 0) {
                        window.growthChartInstance.updateOptions(getGrowthChartOptions(chartData), false, true);
                    }
                } catch (e) {
                    console.warn('[CustomerReport] Dark mode chart error:', e);
                }
            });

            document.addEventListener('livewire:init', function () {
                Livewire.hook('morph.updated', function () {
                    window.initCustomerReportCharts(false);
                });
            });
        })();
    </script>
    @endpush
@endonce
