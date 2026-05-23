<div>
    <?php
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
    ?>

    
    <div class="p-4 bg-white dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Customer Report</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    <strong>
                        <?php echo e($startDate === $endDate
                            ? __('modules.report.salesDataFor') . " $startDate, " . __('modules.report.timePeriod') . " $formattedStartTime - $formattedEndTime"
                            : __('modules.report.salesDataFrom') . " $startDate " . __('app.to') . " $endDate, " . __('modules.report.timePeriodEachDay') . " $formattedStartTime - $formattedEndTime"); ?>

                    </strong>
                </p>
            </div>
            <a href="javascript:;" wire:click='exportReport'
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414A2 2 0 0 0 15.414 6L12 2.586A2 2 0 0 0 10.586 2zm5 6a1 1 0 1 0-2 0v3.586l-1.293-1.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0-1.414-1.414L11 11.586z" clip-rule="evenodd"/></svg>
                <?php echo app('translator')->get('app.export'); ?>
            </a>
        </div>

        
        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 lg:grid-cols-4">
            
            <div class="p-4 bg-skin-base/10 rounded-xl shadow-sm border border-skin-base/30">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-skin-base">Total Customers</h3>
                    <div class="p-2 bg-skin-base/10 rounded-lg">
                        <svg class="w-4 h-4 text-skin-base" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-skin-base"><?php echo e($totalCustomers); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevCustomers > 0): ?>
                    <p class="mt-1 text-xs flex items-center gap-1 <?php echo e($customerChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customerChange >= 0): ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        <?php else: ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php echo e(abs($customerChange)); ?>% vs previous period
                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="p-4 bg-emerald-50 rounded-xl shadow-sm border border-emerald-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-emerald-600">Total Revenue</h3>
                    <div class="p-2 bg-emerald-100 rounded-lg">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-emerald-600"><?php echo e(currency_format($totalRevenue, $currencyId)); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevRevenue > 0): ?>
                    <p class="mt-1 text-xs flex items-center gap-1 <?php echo e($revenueChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($revenueChange >= 0): ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        <?php else: ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php echo e(abs($revenueChange)); ?>% vs previous period
                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="p-4 bg-blue-50 rounded-xl shadow-sm border border-blue-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-blue-600">Average Order Value</h3>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-blue-600"><?php echo e(currency_format($avgOrderValue, $currencyId)); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevAvgOrderValue > 0): ?>
                    <p class="mt-1 text-xs flex items-center gap-1 <?php echo e($aovChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($aovChange >= 0): ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        <?php else: ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php echo e(abs($aovChange)); ?>% vs previous period
                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="p-4 bg-amber-50 rounded-xl shadow-sm border border-amber-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-amber-600">Total Orders</h3>
                    <div class="p-2 bg-amber-100 rounded-lg">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-amber-600"><?php echo e($totalOrders); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prevOrders > 0): ?>
                    <p class="mt-1 text-xs flex items-center gap-1 <?php echo e($orderChange >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderChange >= 0): ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd"/></svg>
                        <?php else: ?>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd"/></svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php echo e(abs($orderChange)); ?>% vs previous period
                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <?php
            $hasTopChart = !empty($chartsPayload['topCustomers']['categories'] ?? []);
            $hasGrowthChart = !empty($chartsPayload['customerGrowth']['labels'] ?? []);
        ?>
        <script type="application/json" id="customer-report-chart-data" data-chart-hash="<?php echo e($chartsPayload['hash'] ?? ''); ?>"><?php echo json_encode($chartsPayload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?></script>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Top 10 Customers by Revenue</h3>
                <div class="relative w-full" style="height:280px">
                    <div id="top-customers-chart" wire:ignore class="w-full h-full"></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$hasTopChart): ?>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 pointer-events-none">
                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            <span class="text-sm">No customer revenue data for this period</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Customer Growth (New Customers)</h3>
                <div class="relative w-full" style="height:280px">
                    <div id="customer-growth-chart" wire:ignore class="w-full h-full"></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$hasGrowthChart): ?>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 pointer-events-none">
                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <span class="text-sm">No customer growth data for this period</span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="flex flex-wrap justify-between items-center gap-4 p-4 bg-gray-50 rounded-lg dark:bg-gray-700 mb-4">
            <div class="lg:flex items-center w-full">
                <form class="w-full" action="#" method="GET">
                    <div class="lg:flex gap-2 items-center w-full">
                        <div class="flex items-center gap-2 mb-2 lg:mb-0">
                            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['id' => 'dateRangeType','class' => 'block w-full sm:w-fit','wire:model.defer' => 'dateRangeType','wire:change' => 'setDateRange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'dateRangeType','class' => 'block w-full sm:w-fit','wire:model.defer' => 'dateRangeType','wire:change' => 'setDateRange']); ?>
                                <option value="today"><?php echo app('translator')->get('app.today'); ?></option>
                                <option value="currentWeek"><?php echo app('translator')->get('app.currentWeek'); ?></option>
                                <option value="lastWeek"><?php echo app('translator')->get('app.lastWeek'); ?></option>
                                <option value="last7Days"><?php echo app('translator')->get('app.last7Days'); ?></option>
                                <option value="currentMonth"><?php echo app('translator')->get('app.currentMonth'); ?></option>
                                <option value="lastMonth"><?php echo app('translator')->get('app.lastMonth'); ?></option>
                                <option value="currentYear"><?php echo app('translator')->get('app.currentYear'); ?></option>
                                <option value="lastYear"><?php echo app('translator')->get('app.lastYear'); ?></option>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                            <div class="flex items-center gap-1">
                                <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.change' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.change' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2686ed4927c64f67d2844e9b73af898c)): ?>
<?php $attributes = $__attributesOriginal2686ed4927c64f67d2844e9b73af898c; ?>
<?php unset($__attributesOriginal2686ed4927c64f67d2844e9b73af898c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2686ed4927c64f67d2844e9b73af898c)): ?>
<?php $component = $__componentOriginal2686ed4927c64f67d2844e9b73af898c; ?>
<?php unset($__componentOriginal2686ed4927c64f67d2844e9b73af898c); ?>
<?php endif; ?>
                                <span class="mx-1 text-gray-500 dark:text-gray-100"><?php echo app('translator')->get('app.to'); ?></span>
                                <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.live' => 'endDate','placeholder' => '@lang(\'app.selectEndDate\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'endDate','placeholder' => '@lang(\'app.selectEndDate\')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2686ed4927c64f67d2844e9b73af898c)): ?>
<?php $attributes = $__attributesOriginal2686ed4927c64f67d2844e9b73af898c; ?>
<?php unset($__attributesOriginal2686ed4927c64f67d2844e9b73af898c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2686ed4927c64f67d2844e9b73af898c)): ?>
<?php $component = $__componentOriginal2686ed4927c64f67d2844e9b73af898c; ?>
<?php unset($__componentOriginal2686ed4927c64f67d2844e9b73af898c); ?>
<?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mb-2 lg:mb-0 lg:ms-2">
                            <div class="w-full max-w-[12rem]">
                                <label for="start-time" class="sr-only"><?php echo app('translator')->get('modules.reservation.timeStart'); ?>:</label>
                                <div x-on:input.debounce.500ms="$wire.set('startTime', $event.detail)">
                                    <?php if (isset($component)) { $__componentOriginaldc20437e6d5b63aa6389f464b229bf5c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.time-picker','data' => ['value' => ''.e($startTime).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('time-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($startTime).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c)): ?>
<?php $attributes = $__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c; ?>
<?php unset($__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc20437e6d5b63aa6389f464b229bf5c)): ?>
<?php $component = $__componentOriginaldc20437e6d5b63aa6389f464b229bf5c; ?>
<?php unset($__componentOriginaldc20437e6d5b63aa6389f464b229bf5c); ?>
<?php endif; ?>
                                </div>
                            </div>
                            <span class="text-gray-500 dark:text-gray-100"><?php echo app('translator')->get('app.to'); ?></span>
                            <div class="w-full max-w-[12rem]">
                                <label for="end-time" class="sr-only"><?php echo app('translator')->get('modules.reservation.timeEnd'); ?>:</label>
                                <div x-on:input.debounce.500ms="$wire.set('endTime', $event.detail)">
                                    <?php if (isset($component)) { $__componentOriginaldc20437e6d5b63aa6389f464b229bf5c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.time-picker','data' => ['value' => ''.e($endTime).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('time-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($endTime).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c)): ?>
<?php $attributes = $__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c; ?>
<?php unset($__attributesOriginaldc20437e6d5b63aa6389f464b229bf5c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc20437e6d5b63aa6389f464b229bf5c)): ?>
<?php $component = $__componentOriginaldc20437e6d5b63aa6389f464b229bf5c; ?>
<?php unset($__componentOriginaldc20437e6d5b63aa6389f464b229bf5c); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 lg:ms-2 lg:flex-1">
                            <div class="relative w-full max-w-xs">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','wire:model.live.debounce.500ms' => 'search','placeholder' => 'Search customers...','class' => 'pl-10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','wire:model.live.debounce.500ms' => 'search','placeholder' => 'Search customers...','class' => 'pl-10']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                            </div>
                            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['wire:model.live' => 'orderTypeFilter','class' => 'w-full sm:w-40']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'orderTypeFilter','class' => 'w-full sm:w-40']); ?>
                                <option value="">All Types</option>
                                <option value="dine_in">Dine In</option>
                                <option value="delivery">Delivery</option>
                                <option value="pickup">Pickup</option>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['wire:model.live' => 'itemFilter','class' => 'w-full sm:w-48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'itemFilter','class' => 'w-full sm:w-48']); ?>
                                <option value="">All Items</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orderedMenuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($menuItem->id); ?>"><?php echo e($menuItem->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="flex flex-wrap gap-2 mb-4">
            <?php
                $tabs = [
                    'all' => 'All',
                    'new' => 'New',
                    'returning' => 'Returning',
                    'at_risk' => 'At-Risk',
                    'vip' => 'VIP',
                ];
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tabLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button wire:click="$set('activeTab', '<?php echo e($tabKey); ?>')"
                    class="px-3 py-1.5 text-xs font-medium rounded-full transition-colors
                        <?php echo e($activeTab === $tabKey
                            ? 'bg-skin-base text-white shadow-sm'
                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'); ?>">
                    <?php echo e($tabLabel); ?>

                    <span class="ml-1 <?php echo e($activeTab === $tabKey ? 'opacity-80' : 'text-gray-400'); ?>">(<?php echo e($tabCounts[$tabKey] ?? 0); ?>)</span>
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($customerData) > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Customer</th>
                        <th scope="col" class="px-4 py-3 text-center">Items</th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('orders_count')">
                            <div class="flex items-center gap-1 justify-end">
                                Orders
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 'orders_count'): ?>
                                    <svg class="w-3 h-3 <?php echo e($sortDirection === 'asc' ? 'rotate-180' : ''); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('total_revenue')">
                            <div class="flex items-center gap-1 justify-end">
                                Revenue
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 'total_revenue'): ?>
                                    <svg class="w-3 h-3 <?php echo e($sortDirection === 'asc' ? 'rotate-180' : ''); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('avg_order_value')">
                            <div class="flex items-center gap-1 justify-end">
                                Avg Value
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 'avg_order_value'): ?>
                                    <svg class="w-3 h-3 <?php echo e($sortDirection === 'asc' ? 'rotate-180' : ''); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-right">Discount</th>
                        <th scope="col" class="px-4 py-3 cursor-pointer select-none" wire:click="sortBy('last_order_date')">
                            <div class="flex items-center gap-1">
                                Last Order
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sortField === 'last_order_date'): ?>
                                    <svg class="w-3 h-3 <?php echo e($sortDirection === 'asc' ? 'rotate-180' : ''); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">Days Since</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customerData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $cid = $item['customer']->id;
                            $itemBadges = $badges[$cid] ?? [];
                            $daysSince = $item['last_order_date']
                                ? \Carbon\Carbon::parse($item['last_order_date'])->diffInDays(\Carbon\Carbon::now())
                                : null;
                        ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-skin-base/10 flex items-center justify-center text-skin-base font-semibold text-sm flex-shrink-0">
                                        <?php echo e(strtoupper(substr($item['customer']->name ?? '?', 0, 1))); ?>

                                    </div>
                                    <div class="min-w-0">
                                        <?php
                                            $favItem = $favoriteItems->get($cid);
                                            $topItemName = $favItem ? $favItem[0]['name'] ?? null : null;
                                            $topItemQty = $favItem ? $favItem[0]['qty'] ?? 0 : 0;
                                        ?>
                                        <p class="font-medium text-gray-900 dark:text-white truncate max-w-[160px]"
                                            <?php if($topItemName): ?>
                                                title="Top item: <?php echo e($topItemName); ?> ×<?php echo e($topItemQty); ?>"
                                            <?php endif; ?>
                                        ><?php echo e($item['customer']->name ?? 'N/A'); ?></p>
                                        <p class="text-xs text-gray-500 truncate max-w-[160px]"><?php echo e($item['customer']->email ?? $item['customer']->phone ?? ''); ?></p>
                                    </div>
                                </div>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($itemBadges) > 0): ?>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $itemBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $badgeStyles = [
                                                    'vip' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                    'new' => 'bg-green-100 text-green-700 border-green-200',
                                                    'repeat' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                    'at_risk' => 'bg-red-100 text-red-700 border-red-200',
                                                ];
                                            ?>
                                            <span class="px-1.5 py-0.5 text-[10px] font-medium rounded border <?php echo e($badgeStyles[$badge] ?? 'bg-gray-100 text-gray-600'); ?>">
                                                <?php echo e(ucfirst(str_replace('_', ' ', $badge))); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                
                                <?php
                                    $favItems = $favoriteItems->get($cid, collect())->take(2);
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($favItems->isNotEmpty()): ?>
                                    <div class="flex flex-wrap gap-x-2 mt-1 text-[10px] text-gray-500 dark:text-gray-400">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $favItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e($fi['name']); ?> <strong class="text-gray-700 dark:text-gray-300">×<?php echo e($fi['qty']); ?></strong></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="font-medium text-gray-900 dark:text-white"><?php echo e($item['items_count']); ?></span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span class="font-semibold text-gray-900 dark:text-white"><?php echo e($item['orders_count']); ?></span>
                            </td>
                            <td class="px-4 py-3 text-right font-semibold text-emerald-600 dark:text-emerald-400">
                                <?php echo e(currency_format($item['total_revenue'], $currencyId)); ?>

                            </td>
                            <td class="px-4 py-3 text-right">
                                <?php echo e(currency_format($item['avg_order_value'], $currencyId)); ?>

                            </td>
                            <td class="px-4 py-3 text-right text-xs">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['total_discount'] > 0): ?>
                                    <span class="text-red-600 dark:text-red-400"><?php echo e(currency_format($item['total_discount'], $currencyId)); ?></span>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-xs whitespace-nowrap">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['last_order_date']): ?>
                                    <?php echo e(\Carbon\Carbon::parse($item['last_order_date'])->setTimezone(timezone())->format($dateFormat)); ?>

                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($daysSince !== null): ?>
                                    <span class="text-xs <?php echo e($daysSince > 30 ? 'text-red-600 font-medium' : 'text-gray-600 dark:text-gray-400'); ?>"><?php echo e($daysSince); ?>d</span>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <button wire:click="openCustomerProfile(<?php echo e($item['customer']->id); ?>)"
                                    class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-skin-base bg-skin-base/10 rounded-lg hover:bg-skin-base/20 transition-colors">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    360°
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                <?php echo app('translator')->get('app.noDataFound'); ?>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <?php echo e($customerData->links()); ?>

        </div>
        <?php else: ?>
        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p><?php echo app('translator')->get('app.noDataFound'); ?></p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showCustomerProfileModal','maxWidth' => '4xl','maxHeight' => 'full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showCustomerProfileModal','maxWidth' => '4xl','maxHeight' => 'full']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-skin-base" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Customer 360° — <?php echo e($selectedCustomerName); ?></span>
            </div>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedCustomerId): ?>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                    <div class="p-3 bg-skin-base/5 rounded-lg border border-skin-base/20 text-center">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Lifetime Orders</p>
                        <p class="text-xl font-bold text-skin-base"><?php echo e($selectedCustomerLifetimeStats['all_orders'] ?? 0); ?></p>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-lg border border-emerald-100 text-center">
                        <p class="text-xs text-gray-500">Lifetime Revenue</p>
                        <p class="text-xl font-bold text-emerald-600"><?php echo e(currency_format($selectedCustomerLifetimeStats['all_revenue'] ?? 0, $currencyId)); ?></p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg border border-blue-100 text-center">
                        <p class="text-xs text-gray-500">First Order Ever</p>
                        <p class="text-sm font-bold text-blue-600">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedCustomerLifetimeStats['first_order_ever']): ?>
                                <?php echo e(\Carbon\Carbon::parse($selectedCustomerLifetimeStats['first_order_ever'])->setTimezone(timezone())->format($dateFormat)); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                    </div>
                    <div class="p-3 bg-amber-50 rounded-lg border border-amber-100 text-center">
                        <p class="text-xs text-gray-500">Period Total</p>
                        <p class="text-xl font-bold text-amber-600"><?php echo e(currency_format($selectedCustomerTotals['total_revenue'] ?? 0, $currencyId)); ?></p>
                    </div>
                </div>

                
                <?php
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
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($favSummary) > 0): ?>
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1.5 font-medium">Favorite Items</p>
                        <div class="flex flex-wrap gap-1.5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $favSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemName => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="px-2 py-1 text-[10px] font-medium bg-skin-base/5 text-skin-base rounded-full border border-skin-base/15">
                                    <?php echo e($itemName); ?> <strong class="ml-0.5">×<?php echo e($qty); ?></strong>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Orders (selected period)</h4>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCustomerOrders) > 0): ?>
                <div class="max-h-[50vh] overflow-y-auto mb-4 space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $selectedCustomerOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div x-data="{ showItems: false }" wire:key="order-wrap-<?php echo e($order->id); ?>">
                            <?php if (isset($component)) { $__componentOriginal2dbe8d657e3ba9219c30c398dcf419e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2dbe8d657e3ba9219c30c398dcf419e3 = $attributes; } ?>
<?php $component = App\View\Components\Order\OrderCard::resolve(['order' => $order] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.order-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Order\OrderCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2dbe8d657e3ba9219c30c398dcf419e3)): ?>
<?php $attributes = $__attributesOriginal2dbe8d657e3ba9219c30c398dcf419e3; ?>
<?php unset($__attributesOriginal2dbe8d657e3ba9219c30c398dcf419e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2dbe8d657e3ba9219c30c398dcf419e3)): ?>
<?php $component = $__componentOriginal2dbe8d657e3ba9219c30c398dcf419e3; ?>
<?php unset($__componentOriginal2dbe8d657e3ba9219c30c398dcf419e3); ?>
<?php endif; ?>
                            <button @click="showItems = !showItems"
                                class="mt-1 w-full flex items-center justify-between px-3 py-1.5 text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <span class="font-medium">
                                    <span x-show="!showItems">Show Items</span>
                                    <span x-show="showItems">Hide Items</span>
                                    (<?php echo e($order->items->count()); ?>)
                                </span>
                                <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': showItems }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="showItems" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="bg-gray-50 dark:bg-gray-700/30 rounded-lg border border-gray-100 dark:border-gray-600/50 divide-y divide-gray-100 dark:divide-gray-600/50">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="px-3 py-2">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs font-medium text-gray-900 dark:text-white truncate"><?php echo e($item->menuItem?->item_name ?? $item->menuItem?->name ?? 'Item #'.$item->menu_item_id); ?></p>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->menuItemVariation): ?>
                                                    <p class="text-[10px] text-gray-500 dark:text-gray-400"><?php echo e($item->menuItemVariation->variation); ?></p>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->note): ?>
                                                    <p class="text-[10px] text-gray-400 italic mt-0.5">Note: <?php echo e($item->note); ?></p>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->modifierOptions->count() > 0): ?>
                                                    <div class="flex flex-wrap gap-1 mt-1">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $item->modifierOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span class="px-1 py-0.5 text-[9px] bg-skin-base/5 text-skin-base rounded border border-skin-base/10">
                                                                <?php echo e($mod->pivot->modifier_option_name ?? $mod->name ?? '+'); ?>

                                                            </span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="text-xs font-semibold text-gray-900 dark:text-white"><?php echo e($item->quantity); ?> × <?php echo e(currency_format($item->price, $currencyId)); ?></p>
                                                <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium"><?php echo e(currency_format($item->amount, $currencyId)); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php else: ?>
                    <p class="text-xs text-gray-400 mb-4">No orders in the selected period.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCustomerReservations) > 0): ?>
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
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $selectedCustomerReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-3 py-2 text-xs"><?php echo e(\Carbon\Carbon::parse($res->reservation_date_time ?? $res->created_at)->setTimezone(timezone())->format($dateFormat)); ?></td>
                                        <td class="px-3 py-2 text-xs"><?php echo e($res->guest_number ?? '-'); ?></td>
                                        <td class="px-3 py-2">
                                            <span class="px-1.5 py-0.5 text-[10px] rounded-full bg-blue-100 text-blue-700"><?php echo e(ucfirst($res->reservation_status ?? 'confirmed')); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedCustomerAddresses) > 0): ?>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Saved Addresses</h4>
                    <div class="space-y-2 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $selectedCustomerAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-2 bg-gray-50 dark:bg-gray-700 rounded text-xs">
                                <p class="text-gray-900 dark:text-white"><?php echo e($addr['address'] ?? $addr['street'] ?? ''); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($addr['city']) || !empty($addr['state'])): ?>
                                    <p class="text-gray-500"><?php echo e($addr['city'] ?? ''); ?><?php echo e(!empty($addr['city']) && !empty($addr['state']) ? ', ' : ''); ?><?php echo e($addr['state'] ?? ''); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <p>Select a customer to view details.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'closeCustomerProfile','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'closeCustomerProfile','wire:loading.attr' => 'disabled']); ?>
                <?php echo e(__('app.close')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $attributes = $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f)): ?>
<?php $component = $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f; ?>
<?php unset($__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f); ?>
<?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($cohortData) > 0): ?>
    <?php
        $maxMonths = 0;
        foreach ($cohortData as $cohort) {
            $cnt = count($cohort['months']);
            if ($cnt > $maxMonths) $maxMonths = $cnt;
        }
    ?>
    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-400 mb-3">Cohort Retention (Monthly)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-3 py-2">Cohort</th>
                        <th class="px-3 py-2 text-right">Size</th>
                        <th class="px-3 py-2 text-right">Month 0</th>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($m = 1; $m <= $maxMonths; $m++): ?>
                            <th class="px-3 py-2 text-right">Month <?php echo e($m); ?></th>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cohortData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cohort): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-3 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap"><?php echo e($cohort['cohort']); ?></td>
                            <td class="px-3 py-2 text-right font-semibold"><?php echo e($cohort['size']); ?></td>
                            <td class="px-3 py-2 text-right font-semibold text-skin-base">100%</td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($m = 1; $m <= $maxMonths; $m++): ?>
                                <?php
                                    $retained = $cohort['months']['month_' . $m] ?? 0;
                                    $pct = $cohort['size'] > 0 ? round($retained / $cohort['size'] * 100, 1) : 0;
                                ?>
                                <td class="px-3 py-2 text-right <?php echo e($pct > 0 ? 'text-skin-base font-medium' : 'text-gray-400'); ?>">
                                    <?php echo e($pct > 0 ? $pct . '%' : '-'); ?>

                                </td>
                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($topItemsData) > 0): ?>
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $topItemsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-3 py-2 font-medium text-gray-900 dark:text-white"><?php echo e($item->item_name ?? $item['item_name'] ?? $item->name ?? ''); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->category_name ?? $item['category_name'] ?? '-'); ?></td>
                            <td class="px-3 py-2 text-right font-semibold"><?php echo e($item->qty_sold ?? $item['qty_sold'] ?? 0); ?></td>
                            <td class="px-3 py-2 text-right font-semibold text-emerald-600 dark:text-emerald-400"><?php echo e(currency_format($item->total_rev ?? $item['total_rev'] ?? 0, $currencyId)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<?php if (! $__env->hasRenderedOnce('92e33ec4-b54b-4ddc-b0e7-a25662d29e8e')): $__env->markAsRenderedOnce('92e33ec4-b54b-4ddc-b0e7-a25662d29e8e'); ?>
    <?php $__env->startPush('scripts'); ?>
    <script>
        (function () {
            var currencySymbol = <?php echo json_encode(currency(), 15, 512) ?>;
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
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/reports/customer-report.blade.php ENDPATH**/ ?>