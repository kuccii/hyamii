<div>
    <div class="p-4 bg-white dark:bg-gray-800">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo app('translator')->get('menu.codReport'); ?></h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><?php echo app('translator')->get('modules.report.codReportMessage'); ?></p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tableMissing): ?>
            <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-700/40 dark:bg-amber-900/10 dark:text-amber-200">
                <?php echo app('translator')->get('modules.delivery.codMonitoringMigrationMessage'); ?>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-4 rounded-xl shadow-sm border border-blue-100 bg-blue-50 dark:bg-blue-900/10 dark:border-blue-800">
                    <div class="text-sm font-medium text-blue-600 dark:text-blue-400"><?php echo app('translator')->get('modules.delivery.totalCodOrders'); ?></div>
                    <div class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-100"><?php echo e($summaryCards['total_orders']); ?></div>
                </div>
                <div class="p-4 rounded-xl shadow-sm border border-amber-100 bg-amber-50 dark:bg-amber-900/10 dark:border-amber-800">
                    <div class="text-sm font-medium text-amber-600 dark:text-amber-400"><?php echo app('translator')->get('modules.report.expectedCodAmount'); ?></div>
                    <div class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-100"><?php echo e(currency_format($summaryCards['expected_amount'], restaurant()->currency_id)); ?></div>
                </div>
                <div class="p-4 rounded-xl shadow-sm border border-cyan-100 bg-cyan-50 dark:bg-cyan-900/10 dark:border-cyan-800">
                    <div class="text-sm font-medium text-cyan-600 dark:text-cyan-400"><?php echo app('translator')->get('modules.report.collectedCodAmount'); ?></div>
                    <div class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-100"><?php echo e(currency_format($summaryCards['collected_amount'], restaurant()->currency_id)); ?></div>
                </div>
                <div class="p-4 rounded-xl shadow-sm border border-emerald-100 bg-emerald-50 dark:bg-emerald-900/10 dark:border-emerald-800">
                    <div class="text-sm font-medium text-emerald-600 dark:text-emerald-400"><?php echo app('translator')->get('modules.report.settledCodAmount'); ?></div>
                    <div class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-100"><?php echo e(currency_format($summaryCards['settled_amount'], restaurant()->currency_id)); ?></div>
                </div>
            </div>

            <div class="mb-4 flex flex-wrap items-center gap-3 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['wire:model.live' => 'dateRangeType','class' => 'block w-fit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'dateRangeType','class' => 'block w-fit']); ?>
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

                <div id="date-range-picker" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <div class="relative w-full sm:w-44">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.change' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')','class' => 'pl-10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.change' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')','class' => 'pl-10']); ?>
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
                    <span class="self-center hidden text-gray-500 sm:block dark:text-gray-100"><?php echo app('translator')->get('app.to'); ?></span>
                    <div class="relative w-full sm:w-44">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.live' => 'endDate','placeholder' => '@lang(\'app.selectEndDate\')','class' => 'pl-10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'endDate','placeholder' => '@lang(\'app.selectEndDate\')','class' => 'pl-10']); ?>
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

                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','wire:model.live.debounce.500ms' => 'search','class' => 'w-full sm:w-64','placeholder' => ''.e(__('modules.report.searchCodReport')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','wire:model.live.debounce.500ms' => 'search','class' => 'w-full sm:w-64','placeholder' => ''.e(__('modules.report.searchCodReport')).'']); ?>
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

                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['wire:model.live' => 'deliveryExecutiveId','class' => 'block w-fit min-w-[200px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'deliveryExecutiveId','class' => 'block w-fit min-w-[200px]']); ?>
                        <option value=""><?php echo app('translator')->get('modules.report.allExecutives'); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $executives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $executive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($executive->id); ?>"><?php echo e($executive->name); ?></option>
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

                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['wire:model.live' => 'status','class' => 'block w-fit min-w-[180px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'status','class' => 'block w-fit min-w-[180px]']); ?>
                        <option value=""><?php echo app('translator')->get('modules.delivery.allStatuses'); ?></option>
                        <option value="pending_collection"><?php echo app('translator')->get('modules.delivery.pendingCollection'); ?></option>
                        <option value="collected"><?php echo app('translator')->get('modules.delivery.collected'); ?></option>
                        <option value="submitted"><?php echo app('translator')->get('modules.delivery.submitted'); ?></option>
                        <option value="settled"><?php echo app('translator')->get('modules.delivery.settled'); ?></option>
                        <option value="rejected"><?php echo app('translator')->get('modules.delivery.rejected'); ?></option>
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

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array('Export Report', restaurant_modules())): ?>
                    <a href="javascript:;" wire:click="exportReport"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414A2 2 0 0 0 15.414 6L12 2.586A2 2 0 0 0 10.586 2zm5 6a1 1 0 1 0-2 0v3.586l-1.293-1.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0-1.414-1.414L11 11.586z" clip-rule="evenodd"/></svg>
                        <?php echo app('translator')->get('app.export'); ?>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex flex-wrap gap-6">
                    <button type="button" wire:click="switchTab('order-status')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'border-b-2 px-1 py-3 text-sm font-medium',
                        'border-skin-base text-skin-base' => $activeTab === 'order-status',
                        'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' => $activeTab !== 'order-status',
                    ]); ?>"><?php echo app('translator')->get('modules.report.orderPaymentStatusReport'); ?></button>
                    <button type="button" wire:click="switchTab('collections')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'border-b-2 px-1 py-3 text-sm font-medium',
                        'border-skin-base text-skin-base' => $activeTab === 'collections',
                        'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' => $activeTab !== 'collections',
                    ]); ?>"><?php echo app('translator')->get('modules.report.codCollectionReport'); ?></button>
                    <button type="button" wire:click="switchTab('pending')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'border-b-2 px-1 py-3 text-sm font-medium',
                        'border-skin-base text-skin-base' => $activeTab === 'pending',
                        'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' => $activeTab !== 'pending',
                    ]); ?>"><?php echo app('translator')->get('modules.report.executivePendingCashReport'); ?></button>
                    <button type="button" wire:click="switchTab('settlements')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'border-b-2 px-1 py-3 text-sm font-medium',
                        'border-skin-base text-skin-base' => $activeTab === 'settlements',
                        'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' => $activeTab !== 'settlements',
                    ]); ?>"><?php echo app('translator')->get('modules.report.settlementHistoryReport'); ?></button>
                </nav>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'order-status'): ?>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.orderNumber'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.orderDate'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.customer.customer'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('menu.deliveryExecutive'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.expectedCodAmount'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.collectedCodAmount'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.status'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.settlementStatus'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tabData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e($item->order?->show_formatted_order_number ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo $__env->make('common.date-time-display', ['date' => $item->order?->date_time], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->order?->customer?->name ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->deliveryExecutive?->name ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->expected_amount, restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) ($item->collected_amount ?? 0), restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e(__('modules.delivery.' . $item->status)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                            <?php echo e(match ($item->status) {
                                                    'settled' => __('modules.delivery.settled'),
                                                    'submitted' => __('modules.delivery.submitted'),
                                                    'collected' => __('modules.delivery.readyForSettlement'),
                                                    default => __('modules.delivery.pendingCollection'),
                                                }); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="8" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.noDataFound'); ?></td></tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    <?php elseif($activeTab === 'collections'): ?>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('menu.deliveryExecutive'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.ordersCount'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.expectedCodAmount'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.collectedCodAmount'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tabData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e($item->deliveryExecutive?->name ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e((int) $item->total_orders); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->expected_amount, restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->collected_amount, restaurant()->currency_id)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.noDataFound'); ?></td></tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    <?php elseif($activeTab === 'pending'): ?>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('menu.deliveryExecutive'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.delivery.dueToCollect'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.delivery.readyForSettlement'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.delivery.submittedForApproval'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.report.ordersCount'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tabData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e($item->deliveryExecutive?->name ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->due_to_collect, restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->ready_for_settlement, restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->submitted_amount, restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e((int) $item->pending_orders); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.noDataFound'); ?></td></tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.delivery.settlementNumber'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('menu.deliveryExecutive'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.delivery.orderCount'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.delivery.submittedAmount'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.note'); ?></th>
                                    <th class="px-4 py-2.5 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.status'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tabData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e($item->settlement_number ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->deliveryExecutive?->name ?? '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->items->count()); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white"><?php echo e(currency_format((float) $item->submitted_amount, restaurant()->currency_id)); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300"><?php echo e($item->notes ?: '--'); ?></td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                            <?php echo e(match ($item->status) {
                                                    'submitted' => __('modules.delivery.submitted'),
                                                    'approved' => __('modules.delivery.settled'),
                                                    'rejected' => __('modules.delivery.rejected'),
                                                    default => ucwords(str_replace('_', ' ', $item->status)),
                                                }); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('app.noDataFound'); ?></td></tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tabData instanceof \Illuminate\Contracts\Pagination\Paginator && $tabData->hasPages()): ?>
                    <div class="border-t border-gray-200 p-4 dark:border-gray-700">
                        <?php echo e($tabData->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/reports/cod-report.blade.php ENDPATH**/ ?>