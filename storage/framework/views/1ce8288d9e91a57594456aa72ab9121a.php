<div>
    <!-- Header Section -->
    <div class="p-4 bg-white dark:bg-gray-800">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo app('translator')->get('menu.taxReport'); ?></h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                <?php
                    $timeFormat = restaurant()->time_format ?? 'h:i A';
                    $formattedStartTime = \Carbon\Carbon::createFromFormat('H:i', $startTime)->format($timeFormat);
                    $formattedEndTime = \Carbon\Carbon::createFromFormat('H:i', $endTime)->format($timeFormat);
                ?>
                <strong>
                    (<?php echo e($startDate === $endDate
                        ? __('modules.report.salesDataFor') . " $startDate, " . __('modules.report.timePeriod') . " $formattedStartTime - $formattedEndTime"
                        : __('modules.report.salesDataFrom') . " $startDate " . __('app.to') . " $endDate, " . __('modules.report.timePeriodEachDay') . " $formattedStartTime - $formattedEndTime"); ?>)
                </strong>
            </p>
        </div>

        <!-- Today's Tax Summary (Prominent) -->
        <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl border-2 border-blue-200 dark:border-blue-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Today's Tax Summary
            </h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Today's Tax Collection</p>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                        <?php echo e(currency_format($todayTaxTotal, restaurant()->currency_id)); ?>

                    </p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Today's Orders</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo e($todayOrdersCount); ?></p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Today's Revenue</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                        <?php echo e(currency_format($todayRevenue, restaurant()->currency_id)); ?>

                    </p>
                </div>
            </div>
        </div>

        <!-- Overall Statistics -->
        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 md:grid-cols-4">
            <!-- Total Tax Card -->
            <div class="p-4 bg-skin-base/10 rounded-xl shadow-sm dark:bg-skin-base/10 border border-skin-base/30 dark:border-skin-base/40">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-skin-base dark:text-skin-base"><?php echo app('translator')->get('modules.report.totalTaxes'); ?></h3>
                    <div class="p-2 bg-skin-base/10 rounded-lg dark:bg-skin-base/10">
                        <svg class="w-4 h-4 text-skin-base dark:text-skin-base" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g stroke-width="0"/><g stroke-linecap="round" stroke-linejoin="round"/><g stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.5 13.75c0 .97.75 1.75 1.67 1.75h1.88c.8 0 1.45-.68 1.45-1.53 0-.91-.4-1.24-.99-1.45l-3.01-1.05c-.59-.21-.99-.53-.99-1.45 0-.84.65-1.53 1.45-1.53h1.88c.92 0 1.67.78 1.67 1.75M12 7.5v9"/><path d="M22 12c0 5.52-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2m10 4V2h-4m-1 5 5-5"/></g></svg>
                    </div>
                </div>
                <p class="text-3xl break-words font-bold text-skin-base dark:text-skin-base">
                    <?php echo e(currency_format($totalTax, restaurant()->currency_id)); ?>

                </p>
            </div>

            <!-- Total Revenue Card -->
            <div class="p-4 bg-emerald-50 rounded-xl shadow-sm dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-800">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-emerald-600 dark:text-emerald-400"><?php echo app('translator')->get('modules.report.totalRevenue'); ?></h3>
                    <div class="p-2 bg-emerald-100 rounded-lg dark:bg-emerald-900/50">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon glyph"><path d="M18.22 17H9.8a2 2 0 0 1-2-1.55L5.2 4H3a1 1 0 0 1 0-2h2.2a2 2 0 0 1 2 1.55L9.8 15h8.42L20 7.76a1 1 0 0 1 2 .48l-1.81 7.25A2 2 0 0 1 18.22 17m-1.72 2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5m-5 0a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5m3.21-9.29 4-4a1 1 0 1 0-1.42-1.42L14 7.59l-1.29-1.3a1 1 0 0 0-1.42 1.42l2 2a1 1 0 0 0 1.42 0" fill="currentColor"/></svg>
                    </div>
                </div>
                <p class="text-3xl break-words font-bold text-gray-800 dark:text-gray-100">
                    <?php echo e(currency_format($totalAmount, restaurant()->currency_id)); ?>

                </p>
            </div>

            <!-- Total Orders Card -->
            <div class="p-4 bg-blue-50 rounded-xl shadow-sm dark:bg-blue-900/10 border border-blue-100 dark:border-blue-800">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-blue-600 dark:text-blue-400"><?php echo app('translator')->get('modules.report.totalOrders'); ?></h3>
                    <div class="p-2 bg-blue-100 rounded-lg dark:bg-blue-900/50">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon glyph"><path d="M18.22 17H9.8a2 2 0 0 1-2-1.55L5.2 4H3a1 1 0 0 1 0-2h2.2a2 2 0 0 1 2 1.55L9.8 15h8.42L20 7.76a1 1 0 0 1 2 .48l-1.81 7.25A2 2 0 0 1 18.22 17m-1.72 2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5m-5 0a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5m3.21-9.29 4-4a1 1 0 1 0-1.42-1.42L14 7.59l-1.29-1.3a1 1 0 0 0-1.42 1.42l2 2a1 1 0 0 0 1.42 0" fill="currentColor"/></svg>
                    </div>
                </div>
                <p class="text-3xl break-words font-bold text-gray-800 dark:text-gray-100">
                    <?php echo e($totalOrders); ?>

                </p>
            </div>

            <!-- Total Items Card -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Items Sold</h3>
                    <div class="p-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon glyph"><path d="M18.22 17H9.8a2 2 0 0 1-2-1.55L5.2 4H3a1 1 0 0 1 0-2h2.2a2 2 0 0 1 2 1.55L9.8 15h8.42L20 7.76a1 1 0 0 1 2 .48l-1.81 7.25A2 2 0 0 1 18.22 17m-1.72 2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5m-5 0a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5m3.21-9.29 4-4a1 1 0 1 0-1.42-1.42L14 7.59l-1.29-1.3a1 1 0 0 0-1.42 1.42l2 2a1 1 0 0 0 1.42 0" fill="currentColor"/></svg>
                    </div>
                </div>
                <p class="text-3xl break-words font-bold text-gray-800 dark:text-gray-100">
                    <?php echo e($totalItems); ?>

                </p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="flex flex-wrap justify-between items-center gap-4 p-4 bg-gray-50 rounded-lg dark:bg-gray-700 mb-6">
            <div class="lg:flex items-center mb-4 sm:mb-0">
                <form class="sm:pr-3" action="#" method="GET">
                    <div class="lg:flex gap-2 items-center">
                        <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['id' => 'dateRangeType','class' => 'block w-full sm:w-fit mb-2 lg:mb-0','wire:model.defer' => 'dateRangeType','wire:change' => 'setDateRange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'dateRangeType','class' => 'block w-full sm:w-fit mb-2 lg:mb-0','wire:model.defer' => 'dateRangeType','wire:change' => 'setDateRange']); ?>
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

                        <div class="flex items-center w-full gap-2">
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
                            <span class="mx-2 text-gray-500 dark:text-gray-100 whitespace-nowrap"><?php echo app('translator')->get('app.to'); ?></span>
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

                        <div class="lg:flex items-center gap-2 ms-2">
                            <div class="w-full max-w-[15rem]">
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
                            <span class="mx-2 text-gray-500 dark:text-gray-100 w-10 text-center"><?php echo app('translator')->get('app.to'); ?></span>
                            <div class="w-full max-w-[15rem]">
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
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap items-center -mb-px">
                <li class="me-2">
                    <span wire:click="$set('activeTab', 'byTaxType')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'inline-flex items-center gap-x-2 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300',
                        'border-transparent' => $activeTab != 'byTaxType',
                        'active border-blue-600 dark:text-blue-500 dark:border-blue-500 text-blue-600 font-semibold' => $activeTab == 'byTaxType',
                    ]); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tax Breakdown by Tax Type
                    </span>
                </li>
                <li class="me-2">
                    <span wire:click="$set('activeTab', 'byDate')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'inline-flex items-center gap-x-2 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300',
                        'border-transparent' => $activeTab != 'byDate',
                        'active border-blue-600 dark:text-blue-500 dark:border-blue-500 text-blue-600 font-semibold' => $activeTab == 'byDate',
                    ]); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Tax Breakdown by Date
                    </span>
                </li>
                <li class="me-2">
                    <span wire:click="$set('activeTab', 'byOrder')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'inline-flex items-center gap-x-2 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300',
                        'border-transparent' => $activeTab != 'byOrder',
                        'active border-blue-600 dark:text-blue-500 dark:border-blue-500 text-blue-600 font-semibold' => $activeTab == 'byOrder',
                    ]); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Tax Details by Order
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tax Breakdown by Tax Type -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab == 'byTaxType'): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($taxBreakdown) > 0): ?>
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tax Breakdown by Tax Type</h2>
            <a href="javascript:;" wire:click='exportReport("byTaxType")'
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414A2 2 0 0 0 15.414 6L12 2.586A2 2 0 0 0 10.586 2zm5 6a1 1 0 1 0-2 0v3.586l-1.293-1.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0-1.414-1.414L11 11.586z" clip-rule="evenodd"/></svg>
                <?php echo app('translator')->get('app.export'); ?>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tax Name</th>
                        <th scope="col" class="px-6 py-3">Tax Rate (%)</th>
                        <th scope="col" class="px-6 py-3">Total Tax Amount</th>
                        <th scope="col" class="px-6 py-3">Items Count</th>
                        <th scope="col" class="px-6 py-3">Orders Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $taxBreakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                <?php echo e($tax['name']); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo e(number_format($tax['percent'], 2)); ?>%
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                <?php echo e(currency_format($tax['total_amount'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">-</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                        <td class="px-6 py-4" colspan="2">Total</td>
                        <td class="px-6 py-4"><?php echo e(currency_format($totalTax, restaurant()->currency_id)); ?></td>
                        <td class="px-6 py-4"><?php echo e($totalItems); ?></td>
                        <td class="px-6 py-4"><?php echo e($totalOrders); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
            <p><?php echo app('translator')->get('app.noDataFound'); ?></p>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Tax Breakdown by Date -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab == 'byDate'): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($taxByDate) > 0): ?>
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tax Breakdown by Date</h2>
            <a href="javascript:;" wire:click='exportReport("byDate")'
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414A2 2 0 0 0 15.414 6L12 2.586A2 2 0 0 0 10.586 2zm5 6a1 1 0 1 0-2 0v3.586l-1.293-1.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0-1.414-1.414L11 11.586z" clip-rule="evenodd"/></svg>
                <?php echo app('translator')->get('app.export'); ?>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Total Tax</th>
                        <th scope="col" class="px-6 py-3">Total Revenue</th>
                        <th scope="col" class="px-6 py-3">Orders</th>
                        <th scope="col" class="px-6 py-3">Items Sold</th>
                        <th scope="col" class="px-6 py-3">Tax Breakdown</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $taxByDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors"
                            wire:click="openDateOrdersModal('<?php echo e($dateData['date']); ?>')">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                <?php echo e($dateData['formatted_date']); ?>

                                <svg class="w-4 h-4 inline-block ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </td>
                            <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">
                                <?php echo e(currency_format($dateData['total_tax'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4 font-semibold text-emerald-600 dark:text-emerald-400">
                                <?php echo e(currency_format($dateData['total_revenue'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo e($dateData['total_orders']); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo e($dateData['total_items']); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($dateData['tax_breakdown']) > 0): ?>
                                    <div class="space-y-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $dateData['tax_breakdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="text-xs">
                                                <span class="font-medium"><?php echo e($taxName); ?></span>
                                                <span class="text-green-600 dark:text-green-400">(<?php echo e(number_format($taxInfo['percent'], 2)); ?>%)</span>:
                                                <span class="font-semibold"><?php echo e(currency_format($taxInfo['amount'], restaurant()->currency_id)); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400 text-xs">No tax breakdown</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                        <td class="px-6 py-4">Total</td>
                        <td class="px-6 py-4 text-blue-600 dark:text-blue-400">
                            <?php echo e(currency_format($totalTax, restaurant()->currency_id)); ?>

                        </td>
                        <td class="px-6 py-4 text-emerald-600 dark:text-emerald-400">
                            <?php echo e(currency_format($totalAmount, restaurant()->currency_id)); ?>

                        </td>
                        <td class="px-6 py-4"><?php echo e($totalOrders); ?></td>
                        <td class="px-6 py-4"><?php echo e($totalItems); ?></td>
                        <td class="px-6 py-4">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
            <p><?php echo app('translator')->get('app.noDataFound'); ?></p>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Tax Details by Order -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab == 'byOrder'): ?>
    <div class="p-4 bg-white dark:bg-gray-800 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tax Details by Order</h2>
            <a href="javascript:;" wire:click='exportReport("byOrder")'
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414A2 2 0 0 0 15.414 6L12 2.586A2 2 0 0 0 10.586 2zm5 6a1 1 0 1 0-2 0v3.586l-1.293-1.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0-1.414-1.414L11 11.586z" clip-rule="evenodd"/></svg>
                <?php echo app('translator')->get('app.export'); ?>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order #</th>
                        <th scope="col" class="px-6 py-3">Date & Time</th>
                        <th scope="col" class="px-6 py-3">Subtotal</th>
                        <th scope="col" class="px-6 py-3">Tax Breakdown</th>
                        <th scope="col" class="px-6 py-3">Total Tax</th>
                        <th scope="col" class="px-6 py-3">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                #<?php echo e($orderDetail['order']->order_number); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php
                                    $dateFormat = restaurant()->date_format ?? 'd-m-Y';
                                    $timeFormat = restaurant()->time_format ?? 'h:i A';
                                    $orderDate = \Carbon\Carbon::parse($orderDetail['order']->date_time)->setTimezone(timezone());
                                ?>
                                <?php echo e($orderDate->format($dateFormat . ' ' . $timeFormat)); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo e(currency_format($orderDetail['subtotal'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($orderDetail['tax_breakdown']) > 0): ?>
                                    <div class="space-y-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orderDetail['tax_breakdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="text-xs">
                                                <span class="font-medium"><?php echo e($taxName); ?></span>
                                                <span class="text-green-600 dark:text-green-400">(<?php echo e(number_format($taxInfo['percent'], 2)); ?>%)</span>:
                                                <span class="font-semibold"><?php echo e(currency_format($taxInfo['amount'], restaurant()->currency_id)); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400">No tax breakdown</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                <?php echo e(currency_format($orderDetail['tax_amount'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4 font-bold">
                                <?php echo e(currency_format($orderDetail['total'], restaurant()->currency_id)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                <?php echo app('translator')->get('app.noDataFound'); ?>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Date Orders Modal -->
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showDateOrdersModal','maxWidth' => '4xl','maxHeight' => 'full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showDateOrdersModal','maxWidth' => '4xl','maxHeight' => 'full']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Tax Details for <?php echo e($selectedDate ? \Carbon\Carbon::createFromFormat('Y-m-d', $selectedDate)->format(restaurant()->date_format ?? 'd-m-Y') : ''); ?></span>
            </div>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedDateOrders) > 0): ?>
            <div class="overflow-x-auto max-h-[70vh]">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th scope="col" class="px-6 py-3">Order #</th>
                            <th scope="col" class="px-6 py-3">Date & Time</th>
                            <th scope="col" class="px-6 py-3">Subtotal</th>
                            <th scope="col" class="px-6 py-3">Tax Breakdown</th>
                            <th scope="col" class="px-6 py-3">Total Tax</th>
                            <th scope="col" class="px-6 py-3">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $selectedDateOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    #<?php echo e($orderDetail['order']->order_number); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                        $dateFormat = restaurant()->date_format ?? 'd-m-Y';
                                        $timeFormat = restaurant()->time_format ?? 'h:i A';
                                        $orderDate = \Carbon\Carbon::parse($orderDetail['order']->date_time)->setTimezone(timezone());
                                    ?>
                                    <?php echo e($orderDate->format($dateFormat . ' ' . $timeFormat)); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php echo e(currency_format($orderDetail['subtotal'], restaurant()->currency_id)); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($orderDetail['tax_breakdown']) > 0): ?>
                                        <div class="space-y-1">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orderDetail['tax_breakdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="text-xs">
                                                    <span class="font-medium"><?php echo e($taxName); ?></span>
                                                    <span class="text-green-600 dark:text-green-400">(<?php echo e(number_format($taxInfo['percent'], 2)); ?>%)</span>:
                                                    <span class="font-semibold"><?php echo e(currency_format($taxInfo['amount'], restaurant()->currency_id)); ?></span>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-xs">No tax breakdown</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="px-6 py-4 font-semibold text-blue-600 dark:text-blue-400">
                                    <?php echo e(currency_format($orderDetail['tax_amount'], restaurant()->currency_id)); ?>

                                </td>
                                <td class="px-6 py-4 font-bold text-emerald-600 dark:text-emerald-400">
                                    <?php echo e(currency_format($orderDetail['total'], restaurant()->currency_id)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <tr class="bg-gray-100 dark:bg-gray-700 font-bold">
                            <td class="px-6 py-4" colspan="2">Total</td>
                            <td class="px-6 py-4">
                                <?php echo e(currency_format($selectedDateTotals['subtotal'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4 text-blue-600 dark:text-blue-400">
                                <?php echo e(currency_format($selectedDateTotals['tax'], restaurant()->currency_id)); ?>

                            </td>
                            <td class="px-6 py-4 text-emerald-600 dark:text-emerald-400">
                                <?php echo e(currency_format($selectedDateTotals['total'], restaurant()->currency_id)); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p>No orders found for this date.</p>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'closeDateOrdersModal','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'closeDateOrdersModal','wire:loading.attr' => 'disabled']); ?>
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

</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/reports/tax-report.blade.php ENDPATH**/ ?>