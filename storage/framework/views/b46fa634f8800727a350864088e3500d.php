<div x-data="<?php echo e(($isDeliveryExecutiveContext && $trackingEnabled) ? 'deliveryExecutiveOrderTracking(' . (int) $deliveryExecutiveId . ')' : '{}'); ?>">
    <div class="p-4  block  dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col gap-3 mb-4 sm:flex-row sm:items-center">
            <div class="flex items-center gap-3">
                <h1 class="text-base font-semibold text-gray-900 dark:text-white">
                    <?php echo app('translator')->get('menu.orders'); ?> (<?php echo e($orders->count()); ?>)
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDeliveryExecutiveContext && $deliveryExecutiveName): ?>
                        - <?php echo e($deliveryExecutiveName); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </h1>
            </div>
            <div class="sm:ml-auto w-full sm:w-auto">
                <div class="flex flex-col sm:flex-row sm:items-center flex-wrap gap-2 w-full sm:w-auto">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isDeliveryExecutiveContext): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(pusherSettings()->is_enabled_pusher_broadcast): ?>
                            <div class="flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <?php echo app('translator')->get('app.realTime'); ?>
                            </div>
                        <?php else: ?>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                                <label class="relative inline-flex items-center cursor-pointer w-full sm:w-auto">
                                    <input type="checkbox" class="sr-only peer" wire:model.live="pollingEnabled">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-skin-base rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-skin-base"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"><?php echo app('translator')->get('app.autoRefresh'); ?></span>
                                </label>
                                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['class' => 'w-full sm:w-32 text-sm','wire:model.live' => 'pollingInterval','disabled' => !$pollingEnabled]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full sm:w-32 text-sm','wire:model.live' => 'pollingInterval','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(!$pollingEnabled)]); ?>
                                    <option value="5">5 <?php echo app('translator')->get('app.seconds'); ?></option>
                                    <option value="10">10 <?php echo app('translator')->get('app.seconds'); ?></option>
                                    <option value="15">15 <?php echo app('translator')->get('app.seconds'); ?></option>
                                    <option value="30">30 <?php echo app('translator')->get('app.seconds'); ?></option>
                                    <option value="60">1 <?php echo app('translator')->get('app.minute'); ?></option>
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
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isDeliveryExecutiveContext): ?>
                        <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['class' => 'w-full sm:w-32 text-sm','wire:model.live.debounce.250ms' => 'filterOrderType']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full sm:w-32 text-sm','wire:model.live.debounce.250ms' => 'filterOrderType']); ?>
                            <option value=""><?php echo app('translator')->get('modules.order.all'); ?></option>
                            <option value="dine_in"><?php echo app('translator')->get('modules.order.dine_in'); ?></option>
                            <option value="delivery"><?php echo app('translator')->get('modules.order.delivery'); ?></option>
                            <option value="pickup"><?php echo app('translator')->get('modules.order.pickup'); ?></option>
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
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['class' => 'w-full sm:w-40 text-sm','wire:model.live.debounce.250ms' => 'filterDeliveryApp']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full sm:w-40 text-sm','wire:model.live.debounce.250ms' => 'filterDeliveryApp']); ?>
                        <option value=""><?php echo app('translator')->get('modules.report.allDeliveryApps'); ?></option>
                        <option value="direct"><?php echo app('translator')->get('modules.report.directDelivery'); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $deliveryApps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($app->id); ?>"><?php echo e($app->name); ?></option>
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

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDeliveryExecutiveContext && $backUrl): ?>
                        <div class="w-full sm:w-auto sm:ml-auto">
                            <a href="<?php echo e($backUrl); ?>"
                                class="inline-flex items-center justify-center w-full sm:w-auto px-3 py-2 text-sm font-medium text-gray-800 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                                <?php echo app('translator')->get('app.back'); ?>
                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        <?php
            $orderStats = getRestaurantOrderStats(branch()->id);
            $canCreateOrder = user_can('Create Order');
            $orderLimitExceeded = $canCreateOrder && $orderStats && !$orderStats['unlimited'] && $orderStats['current_count'] >= $orderStats['order_limit'];
        ?>

        <!-- First Line: dateRangeType, startDate, endDate, filterOrders -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-4">
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

            <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.change' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')','class' => 'pt-1 w-full sm:w-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.change' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')','class' => 'pt-1 w-full sm:w-auto']); ?>
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
                <span class="hidden sm:inline mx-2 text-gray-500 dark:text-gray-100 whitespace-nowrap"><?php echo app('translator')->get('app.to'); ?></span>
                <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.live' => 'endDate','placeholder' => '@lang(\'app.selectEndDate\')','class' => 'pt-1 w-full sm:w-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'endDate','placeholder' => '@lang(\'app.selectEndDate\')','class' => 'pt-1 w-full sm:w-auto']); ?>
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

            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['class' => 'text-sm w-full sm:w-auto','wire:model.live.debounce.250ms' => 'filterOrders']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-sm w-full sm:w-auto','wire:model.live.debounce.250ms' => 'filterOrders']); ?>
                <option value=""><?php echo app('translator')->get('app.showAll'); ?> <?php echo app('translator')->get('menu.orders'); ?></option>
                <option value="draft"><?php echo app('translator')->get('modules.order.draft'); ?> (<?php echo e($draftOrdersCount); ?>)</option>
                <option value="kot"><?php echo app('translator')->get('modules.order.kot'); ?> (<?php echo e($kotCount); ?>)</option>
                <option value="billed"><?php echo app('translator')->get('modules.order.billed'); ?> (<?php echo e($billedCount); ?>)</option>
                <option value="paid"><?php echo app('translator')->get('modules.order.paid'); ?> (<?php echo e($paidOrdersCount); ?>)</option>
                <option value="canceled"><?php echo app('translator')->get('modules.order.canceled'); ?> (<?php echo e($canceledOrdersCount); ?>)</option>
                <option value="out_for_delivery"><?php echo app('translator')->get('modules.order.out_for_delivery'); ?> (<?php echo e($outDeliveryOrdersCount); ?>)</option>
                <option value="payment_due"><?php echo app('translator')->get('modules.order.payment_due'); ?> (<?php echo e($paymentDueCount); ?>)</option>
                <option value="delivered"><?php echo app('translator')->get('modules.order.delivered'); ?> (<?php echo e($deliveredOrdersCount); ?>)</option>
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!user()->hasRole('Waiter_' . user()->restaurant_id)): ?>
            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['class' => 'text-sm w-full sm:w-auto','wire:model.live.debounce.250ms' => 'filterWaiter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-sm w-full sm:w-auto','wire:model.live.debounce.250ms' => 'filterWaiter']); ?>
                <option value=""><?php echo app('translator')->get('app.showAll'); ?> <?php echo app('translator')->get('modules.order.waiter'); ?></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $waiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($waiter->id); ?>"><?php echo e($waiter->name); ?></option>
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
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Second Line: filterWaiter, filterShift, Business Day Info, and buttons -->
        <div class="flex flex-col sm:flex-row sm:items-center flex-wrap gap-2 mb-4">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isToday && $filteredShifts && $filteredShifts->count() > 0): ?>
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['class' => 'text-sm w-full sm:w-auto','wire:model.live.debounce.250ms' => 'filterShift']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-sm w-full sm:w-auto','wire:model.live.debounce.250ms' => 'filterShift']); ?>
                    <option value=""><?php echo app('translator')->get('app.showAll'); ?> <?php echo app('translator')->get('modules.settings.operationalShifts'); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $filteredShifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($shift->id); ?>">
                            <?php echo e($shift->shift_name ?: __('modules.settings.shift') . ' #' . $shift->id); ?>

                            (<?php echo e($shift->start_time_display ?? $shift->start_time_local ?? $shift->start_time); ?> -
                            <?php echo e($shift->end_time_display ?? $shift->end_time_local ?? $shift->end_time); ?>)
                        </option>
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
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Business Day Information Alert (Inline) - Only show if today is selected -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isToday && $businessDayInfo): ?>
                <div class="relative inline-block" x-data="{ showTooltip: false }" @click.outside="showTooltip = false" @keydown.escape.window="showTooltip = false">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($businessDayInfo['extends_to_next_day']): ?>
                    <div
                        class="px-3 py-2.5 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900/20 dark:border-blue-800 cursor-pointer sm:cursor-help whitespace-nowrap"
                        @mouseenter="if (window.innerWidth >= 640) showTooltip = true"
                        @mouseleave="if (window.innerWidth >= 640) showTooltip = false"
                        @click="if (window.innerWidth < 640) showTooltip = !showTooltip"
                        @keydown.enter.prevent="showTooltip = !showTooltip"
                        @keydown.space.prevent="showTooltip = !showTooltip"
                        tabindex="0"
                    >
                    <?php else: ?>
                    <div
                        class="px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-900/20 dark:border-gray-800 cursor-pointer sm:cursor-help whitespace-nowrap"
                        @mouseenter="if (window.innerWidth >= 640) showTooltip = true"
                        @mouseleave="if (window.innerWidth >= 640) showTooltip = false"
                        @click="if (window.innerWidth < 640) showTooltip = !showTooltip"
                        @keydown.enter.prevent="showTooltip = !showTooltip"
                        @keydown.space.prevent="showTooltip = !showTooltip"
                        tabindex="0"
                    >
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs font-medium text-blue-900 dark:text-blue-200">
                                <?php echo app('translator')->get('modules.settings.businessDayInfo'); ?>
                            </span>
                        </div>
                        <!-- Hover Tooltip -->
                        <div
                            x-show="showTooltip"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute left-0 top-full mt-2 p-3 bg-gray-900 text-white text-xs rounded-lg shadow-lg z-50 pointer-events-none"
                            style="display: none; width: 320px; max-width: 90vw; box-sizing: border-box; overflow: hidden;"
                            x-cloak
                        >
                            <div style="word-wrap: break-word; overflow-wrap: break-word; width: 100%;">
                                <p class="font-semibold mb-2 text-white" style="word-wrap: break-word; overflow-wrap: break-word; width: 100%;"><?php echo app('translator')->get('modules.settings.businessDayInfo'); ?></p>
                                <p class="mb-2 leading-relaxed text-white" style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal; width: 100%;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($businessDayInfo['extends_to_next_day']): ?>
                                    <?php echo app('translator')->get('modules.settings.businessDayResetsAt', ['time' => $businessDayInfo['start']]); ?>
                                    <?php echo app('translator')->get('app.to'); ?> <?php echo e($businessDayInfo['end']); ?>

                                    (<?php echo app('translator')->get('app.on'); ?> <?php echo e(\Carbon\Carbon::parse($businessDayInfo['end_date'])->translatedFormat(restaurant()->date_format ?? 'd-m-Y')); ?>)
                                    <?php else: ?>
                                    <?php echo app('translator')->get('modules.settings.businessDayResetsAt', ['time' => $businessDayInfo['start']]); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($businessDayInfo['start'] != $businessDayInfo['end']): ?>
                                        <?php echo app('translator')->get('app.to'); ?> <?php echo e($businessDayInfo['end']); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </p>
                                <p class="text-gray-300 leading-relaxed mt-2 text-sm" style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal; width: 100%;">
                                    <?php echo app('translator')->get('modules.settings.businessDayExtendsInfo'); ?>
                                </p>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($businessDayInfo['extends_to_next_day']): ?>
                            <div class="absolute -top-2 left-4 w-0 h-0 border-l-8 border-r-8 border-b-8 border-transparent border-b-gray-900"></div>
                            <?php else: ?>
                            <div class="absolute -top-2 left-4 w-0 h-0 border-l-8 border-r-8 border-b-8 border-transparent border-b-gray-900"></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isDeliveryExecutiveContext && $canCreateOrder && $orderStats && ($orderStats['unlimited'] || $orderStats['current_count'] < $orderStats['order_limit'])): ?>
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto sm:ml-auto">
                    <?php if (isset($component)) { $__componentOriginalecbfaf65020c31547e71f42b3a8afb5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-link','data' => ['class' => 'w-full sm:w-auto justify-center','href' => ''.e(route('pos.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full sm:w-auto justify-center','href' => ''.e(route('pos.index')).'']); ?><?php echo app('translator')->get('modules.order.newOrder'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f)): ?>
<?php $attributes = $__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f; ?>
<?php unset($__attributesOriginalecbfaf65020c31547e71f42b3a8afb5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalecbfaf65020c31547e71f42b3a8afb5f)): ?>
<?php $component = $__componentOriginalecbfaf65020c31547e71f42b3a8afb5f; ?>
<?php unset($__componentOriginalecbfaf65020c31547e71f42b3a8afb5f); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full sm:w-auto justify-center','wire:click' => 'openMergeModal','type' => 'button']); ?><?php echo app('translator')->get('modules.order.mergeOrder'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orderLimitExceeded): ?>
            <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg dark:bg-red-900/20 dark:border-red-800">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-red-800 dark:text-red-300">
                            <?php echo app('translator')->get('modules.order.orderLimitExceeded'); ?>
                        </h3>
                        <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                            <?php echo app('translator')->get('modules.order.orderLimitExceededMessage', [
                                'current' => number_format($orderStats['current_count']),
                                'limit' => number_format($orderStats['order_limit'])
                            ]); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="flex flex-col my-4 px-4">
            <!-- Card Section -->
            <div class="space-y-4">
                <div class="grid sm:grid-cols-3 2xl:grid-cols-4 gap-3 sm:gap-4" wire:key="orders-grid" wire:loading.class.delay="opacity-50">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $progressStatus = is_object($item->order_status) ? $item->order_status->value : $item->order_status;
                            $isOutForDelivery = in_array((string) $progressStatus, ['out_for_delivery', 'reached_destination'], true);
                            $isDelivered = in_array((string) $progressStatus, ['delivered', 'served'], true);
                        ?>
                        <?php if (isset($component)) { $__componentOriginal2dbe8d657e3ba9219c30c398dcf419e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2dbe8d657e3ba9219c30c398dcf419e3 = $attributes; } ?>
<?php $component = App\View\Components\Order\OrderCard::resolve(['order' => $item] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.order-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Order\OrderCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => 'order-'.e($item->id).'','showTrackButton' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDeliveryExecutiveContext && $trackingEnabled && $item->order_type == 'delivery' && $isOutForDelivery),'showDeliveredButton' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDeliveryExecutiveContext && $item->order_type == 'delivery' && $isDelivered),'trackEndpoint' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDeliveryExecutiveContext && $trackingEnabled ? route('delivery-executives.tracking-data', ['delivery_executive' => $deliveryExecutiveId, 'order' => $item]) : null),'trackOrderLabel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('#' . $item->show_formatted_order_number),'showLiveBlink' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDeliveryExecutiveContext && $trackingEnabled && $item->order_type == 'delivery' && $isOutForDelivery)]); ?>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasMore): ?>
                    <div
                        class="py-6 text-center text-gray-500 dark:text-gray-400"
                        x-data
                        x-intersect="$wire.call('loadMore')"
                        wire:key="orders-load-more"
                    >
                        <div wire:loading wire:target="loadMore" class="flex items-center justify-center gap-2 text-sm">
                            <svg class="w-4 h-4 animate-spin text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 100 16v-4l-3.5 3.5L12 24v-4a8 8 0 01-8-8z"></path>
                            </svg>
                        </div>
                        <div wire:loading.remove wire:target="loadMore" class="text-sm text-gray-400 dark:text-gray-500">
                            <?php echo app('translator')->get('app.loadMore'); ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <!-- End Card Section -->
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDeliveryExecutiveContext && $trackingEnabled): ?>
            <div x-show="trackModalOpen" class="fixed inset-0 z-50" style="display: none;">
                <div class="absolute inset-0 bg-gray-900/50" @click="closeTrackModal()"></div>

                <div x-show="trackModalOpen"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="absolute right-0 top-0 h-full w-full sm:max-w-3xl bg-white dark:bg-gray-800 shadow-xl flex flex-col">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Order <span x-text="selectedOrderLabel"></span></h2>
                        <button type="button" @click="closeTrackModal()" class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                            <?php echo app('translator')->get('app.close'); ?>
                        </button>
                    </div>

                    <div class="flex-1 overflow-hidden relative">
                        <template x-if="trackingError">
                            <div class="absolute top-4 left-4 right-4 z-10 p-3 text-sm text-red-700 bg-red-100 border border-red-200 rounded dark:bg-red-900/20 dark:text-red-300 dark:border-red-900/40" x-text="trackingError"></div>
                        </template>

                        <div x-show="lastUpdatedAt && !trackingError" style="display: none;" class="absolute top-4 right-4 z-10 px-3 py-2 rounded bg-white/90 dark:bg-gray-900/90 text-xs text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                            <span><?php echo app('translator')->get('app.lastUpdate'); ?>: </span><span x-text="lastUpdatedAt || '--'"></span>
                        </div>

                        <div id="executive-tracking-map" class="h-full w-full"></div>

                        <template x-if="!isMapReady && !trackingError">
                            <div class="h-full w-full flex items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                                <?php echo app('translator')->get('app.loadingMap'); ?>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showMergeModal','maxWidth' => '4xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showMergeModal','maxWidth' => '4xl']); ?>
         <?php $__env->slot('title', null, []); ?> 
            <?php echo app('translator')->get('modules.order.mergeOrder'); ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content', null, []); ?> 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($unpaidOrders) > 0): ?>
                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                    <p class="text-sm text-blue-800 dark:text-blue-300">
                        <?php echo app('translator')->get('modules.order.selectOrdersToMerge'); ?>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $unpaidOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800 <?php echo e(in_array($order->id, $selectedOrders) ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300 dark:border-blue-700' : ''); ?>">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    wire:model.live="selectedOrders"
                                    value="<?php echo e($order->id); ?>"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                >
                            </div>
                            <div class="flex items-center justify-between flex-1">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="flex flex-col">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">
                                            <?php echo e($order->show_formatted_order_number ?? '--'); ?>

                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->table): ?>
                                                <?php echo app('translator')->get('modules.table.table'); ?>: <?php echo e($order->table->table_code); ?>

                                            <?php elseif($order->customer): ?>
                                                <?php echo e($order->customer->name ?? __('modules.customer.walkin')); ?>

                                            <?php else: ?>
                                                --
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->orderType): ?>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <?php echo e($order->orderType->order_type_name); ?>

                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'text-xs font-medium px-2 py-1 rounded uppercase tracking-wide',
                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-400 border border-yellow-400' =>
                                                $order->status == 'kot',
                                            'bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-blue-400 border border-blue-400' =>
                                                $order->status == 'billed' || $order->status == 'out_for_delivery',
                                            'bg-red-100 text-red-800 dark:bg-gray-700 dark:text-red-400 border border-red-400' =>
                                                $order->status == 'payment_due',
                                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 border border-gray-400' =>
                                                $order->status == 'draft',
                                        ]); ?>">
                                            <?php echo app('translator')->get('modules.order.' . $order->status); ?>
                                        </span>
                                        <div class="text-sm font-medium text-gray-800 dark:text-gray-300 mt-2">
                                            <?php echo e(currency_format($order->total, restaurant()->currency_id)); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedOrders) > 0): ?>
                    <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong><?php echo e(count($selectedOrders)); ?></strong> <?php echo app('translator')->get('modules.order.ordersSelected'); ?>
                        </p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('modules.order.noUnpaidOrders'); ?></p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php $__env->endSlot(); ?>

         <?php $__env->slot('footer', null, []); ?> 
            <div class="flex justify-end items-center gap-3">
                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'closeMergeModal','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'closeMergeModal','wire:loading.attr' => 'disabled']); ?>
                    <?php echo app('translator')->get('app.close'); ?>
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selectedOrders) >= 2): ?>
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'mergeOrders','wire:loading.attr' => 'disabled','wire:target' => 'mergeOrders']); ?>
                        <span wire:loading.remove wire:target="mergeOrders">
                            <?php echo app('translator')->get('modules.order.mergeSelectedOrders'); ?>
                        </span>
                        <span wire:loading wire:target="mergeOrders">
                            <?php echo app('translator')->get('modules.order.merging'); ?>...
                        </span>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
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

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($playSound): ?>
    <script>
        new Audio("<?php echo e(asset('sound/new_order.wav')); ?>").play();
    </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php
        $__scriptKey = '2669820959-0';
        ob_start();
    ?>
    <script>

        // Handle polling
        let pollingInterval = null;
        let pusherChannel = null;

        function startPolling() {
            console.log('🔄 Starting polling for orders...');
            if (pollingInterval) {
                console.log('🔄 Clearing existing polling interval');
                clearInterval(pollingInterval);
            }
            const interval = $wire.get('pollingInterval') * 1000;
            console.log('📊 Orders polling settings:', {
                interval: interval,
                intervalSeconds: $wire.get('pollingInterval'),
                pollingEnabled: $wire.get('pollingEnabled')
            });
            pollingInterval = setInterval(() => {
                if ($wire.get('pollingEnabled')) {
                    console.log('🔄 Orders polling: Refreshing data...');
                    $wire.$refresh();
                } else {
                    console.log('⏸️ Orders polling: Disabled, stopping...');
                    stopPolling();
                }
            }, interval);
            console.log('✅ Orders polling started');
        }

        function stopPolling() {
            console.log('🛑 Stopping polling for orders...');
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
                console.log('✅ Orders polling stopped');
            } else {
                console.log('⚠️ Orders polling was already stopped');
            }
        }

        function initializePusher() {
            try {
                console.log('🚀 Initializing Pusher for orders...');

                if (typeof window.PUSHER === 'undefined') {
                    console.error('❌ PUSHER is not defined for orders');
                    return;
                }

                console.log('📊 Pusher orders connection state:', window.PUSHER.connection.state);
                console.log('🔗 Pusher orders connection options:', {
                    encrypted: window.PUSHER.connection.options.encrypted,
                    cluster: window.PUSHER.connection.options.cluster,
                    key: window.PUSHER.connection.options.key ? '***' + window.PUSHER.connection.options.key.slice(-4) : 'undefined'
                });

                // Add comprehensive connection event listeners
                window.PUSHER.connection.bind('connected', () => {
                    console.log('✅ Pusher orders connected successfully!');
                    console.log('📊 Pusher orders connection ID:', window.PUSHER.connection.connection_id);
                    console.log('🔗 Pusher orders socket ID:', window.PUSHER.connection.socket_id);
                });

                window.PUSHER.connection.bind('disconnected', () => {
                    console.log('❌ Pusher orders disconnected!');
                });



                window.PUSHER.connection.bind('connecting', () => {
                    console.log('🔄 Pusher orders connecting...');
                });

                window.PUSHER.connection.bind('reconnecting', () => {
                    console.log('🔄 Pusher orders reconnecting...');
                });

                // Listen for Livewire events for new orders (works even without Pusher)
                Livewire.on('newOrderCreated', (data) => {
                    console.log('✅ Livewire event received for new order!', data);
                    // Play sound immediately for new order
                    new Audio("<?php echo e(asset('sound/new_order.wav')); ?>").play();
                    // Refresh the component to show new order
                    $wire.call('refreshNewOrders');
                });

                window.PUSHER.connection.bind('reconnected', () => {
                    console.log('✅ Pusher orders reconnected!');
                    console.log('📊 Pusher orders reconnection details:', {
                        socketId: window.PUSHER.connection.socket_id,
                        connectionId: window.PUSHER.connection.connection_id,
                        state: window.PUSHER.connection.state
                    });
                });

                // Add connection retry logic
                let connectionRetryCount = 0;
                const maxRetries = 3;

                    window.PUSHER.connection.bind('error', (error) => {
                    connectionRetryCount++;
                    console.error(`❌ Pusher orders connection error (attempt ${connectionRetryCount}/${maxRetries}):`, error);
                    console.error('❌ Pusher orders error details:', {
                        type: error.type,
                        error: error.error,
                        data: error.data,
                        message: error.message,
                        code: error.code
                    });

                    // Log additional debugging info
                    console.error('🔍 Pusher orders debugging info:', {
                        connectionState: window.PUSHER.connection.state,
                        socketId: window.PUSHER.connection.socket_id,
                        connectionId: window.PUSHER.connection.connection_id,
                        options: window.PUSHER.connection.options,
                        url: window.PUSHER.connection.options.wsHost || 'default',
                        encrypted: window.PUSHER.connection.options.encrypted,
                        cluster: window.PUSHER.connection.options.cluster
                    });

                    // Check if it's a WebSocket error
                    if (error.type === 'WebSocketError') {
                        console.error('🌐 WebSocket specific error:', {
                            wsError: error.error,
                            wsErrorType: error.error?.type,
                            wsErrorData: error.error?.data
                        });

                        // Check for quota exceeded error
                        if (error.error?.data?.code === 4004) {
                            console.error('❌ PUSHER QUOTA EXCEEDED: Account has exceeded its usage limits');
                            console.error('💡 Solutions:');
                            console.error('   1. Upgrade your Pusher plan');
                            console.error('   2. Reduce connection count');
                            console.error('   3. Switch to polling mode temporarily');

                            // Automatically fall back to polling after quota error
                            if (connectionRetryCount >= 2) {
                                console.error('🔄 Falling back to polling due to quota exceeded');
                                stopPusher();
                                if ($wire.get('pollingEnabled')) {
                                    startPolling();
                                }
                            }
                        }
                    }

                    if (connectionRetryCount >= maxRetries) {
                        console.error('❌ Pusher orders: Max retry attempts reached, falling back to polling');
                        // Fall back to polling
                        stopPusher();
                        if ($wire.get('pollingEnabled')) {
                            startPolling();
                        }
                    }
                });

                window.PUSHER.connection.bind('connected', () => {
                    connectionRetryCount = 0; // Reset retry count on successful connection
                    console.log('✅ Pusher orders connected successfully!');
                    console.log('📊 Pusher orders connection ID:', window.PUSHER.connection.connection_id);
                    console.log('🔗 Pusher orders socket ID:', window.PUSHER.connection.socket_id);

                    // Log connection for monitoring (optional - remove if not needed)
                    try {
                        fetch('/api/log-pusher-connection', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                socket_id: window.PUSHER.connection.socket_id,
                                connection_id: window.PUSHER.connection.connection_id,
                                component: 'orders',
                                timestamp: new Date().toISOString()
                            })
                        }).catch(err => console.log('📊 Connection logging failed (optional):', err));
                    } catch (err) {
                        console.log('📊 Connection logging not available');
                    }
                });

                // Subscribe to orders channel
                console.log('📡 Subscribing to orders channel...');
                pusherChannel = window.PUSHER.subscribe('orders');

                // Add comprehensive subscription event listeners
                pusherChannel.bind('pusher:subscription_succeeded', () => {
                    console.log('✅ Pusher orders: Successfully subscribed to orders channel!');
                    console.log('📊 Pusher orders channel state:', {
                        subscribed: pusherChannel.subscribed,
                        subscriptionPending: pusherChannel.subscriptionPending,
                        name: pusherChannel.name
                    });
                });

                pusherChannel.bind('pusher:subscription_error', (error) => {
                    console.error('❌ Pusher orders subscription error:', error);
                    console.error('❌ Pusher orders subscription error details:', {
                        error: error.error,
                        type: error.type,
                        data: error.data
                    });
                });

                // Bind to order events
                pusherChannel.bind('order.updated', function(data) {
                    console.log('🎉 Pusher orders: Order updated via Pusher:', data);
                    console.log('📊 Pusher orders: Order update details:', {
                        order_id: data.order_id,
                        timestamp: new Date().toISOString(),
                        event_type: 'order.updated'
                    });
                    $wire.$refresh();
                });

                pusherChannel.bind('order.created', function(data) {
                    console.log('🎉 Pusher orders: New order created via Pusher:', data);
                    console.log('📊 Pusher orders: Order creation details:', {
                        order_id: data.order_id,
                        order_number: data.order_number,
                        timestamp: new Date().toISOString(),
                        event_type: 'order.created'
                    });
                    // Play sound for new order
                    new Audio("<?php echo e(asset('sound/new_order.wav')); ?>").play();
                    // Trigger handleNewOrder to show popup
                    $wire.call('handleNewOrder', data);
                });

                // Debug: show all event bindings on the channel
                if (pusherChannel && typeof pusherChannel.eventNames === 'function') {
                    console.log('📋 Pusher orders channel event bindings:', pusherChannel.eventNames());
                }

                // Check if the channel is actually subscribed
                if (pusherChannel && typeof pusherChannel.subscriptionPending !== 'undefined') {
                    if (pusherChannel.subscriptionPending) {
                        console.log('⏳ Pusher orders subscription is pending...');
                    } else if (pusherChannel.subscribed) {
                        console.log('✅ Pusher orders channel is subscribed.');
                    } else {
                        console.log('❌ Pusher orders channel is not subscribed yet.');
                    }
                }

                // Log channel properties
                console.log('📊 Pusher orders channel properties:', {
                    name: pusherChannel.name,
                    subscribed: pusherChannel.subscribed,
                    subscriptionPending: pusherChannel.subscriptionPending,
                    eventNames: typeof pusherChannel.eventNames === 'function' ? pusherChannel.eventNames() : 'N/A'
                });

                // Log connection details
                console.log('📊 Pusher orders connection details:', {
                    state: window.PUSHER.connection.state,
                    socket_id: window.PUSHER.connection.socket_id,
                    connection_id: window.PUSHER.connection.connection_id,
                    options: {
                        encrypted: window.PUSHER.connection.options.encrypted,
                        cluster: window.PUSHER.connection.options.cluster,
                        key: window.PUSHER.connection.options.key ? '***' + window.PUSHER.connection.options.key.slice(-4) : 'undefined'
                    }
                });

                console.log('✅ Pusher orders initialized successfully');

            } catch (error) {
                console.error('❌ Pusher orders initialization failed:', error);
                console.error('❌ Pusher orders error stack:', error.stack);
            }
        }

        function stopPusher() {
            console.log('🛑 Stopping Pusher for orders...');
            if (pusherChannel) {
                console.log('📊 Pusher orders channel state before unsubscribe:', {
                    name: pusherChannel.name,
                    subscribed: pusherChannel.subscribed,
                    subscriptionPending: pusherChannel.subscriptionPending
                });
                pusherChannel.unsubscribe();
                console.log('✅ Pusher orders channel unsubscribed');
                pusherChannel = null;
            } else {
                console.log('⚠️ Pusher orders channel was already null');
            }

            // Clean up any event listeners
            if (window.PUSHER && window.PUSHER.connection) {
                try {
                    window.PUSHER.connection.unbind('connected');
                    window.PUSHER.connection.unbind('disconnected');
                    window.PUSHER.connection.unbind('error');
                    window.PUSHER.connection.unbind('connecting');
                    window.PUSHER.connection.unbind('reconnecting');
                    window.PUSHER.connection.unbind('reconnected');
                    console.log('🧹 Pusher orders connection event listeners cleaned up');
                } catch (err) {
                    console.log('⚠️ Error cleaning up Pusher event listeners:', err);
                }
            }
        }

                function testPusherConnection() {
            console.log('🧪 Testing Pusher connection...');
            console.log('📊 Pusher settings:', {
                defined: typeof window.PUSHER !== 'undefined',
                settingsDefined: typeof window.PUSHER_SETTINGS !== 'undefined',
                broadcastEnabled: typeof window.PUSHER_SETTINGS !== 'undefined' ? window.PUSHER_SETTINGS.is_enabled_pusher_broadcast : 'undefined'
            });

            if (typeof window.PUSHER_SETTINGS !== 'undefined') {
                console.log('📊 PUSHER_SETTINGS details:', {
                    pusher_key: window.PUSHER_SETTINGS.pusher_key,
                    pusher_cluster: window.PUSHER_SETTINGS.pusher_cluster,
                    pusher_app_id: window.PUSHER_SETTINGS.pusher_app_id,
                    is_enabled_pusher_broadcast: window.PUSHER_SETTINGS.is_enabled_pusher_broadcast
                });
            }

            if (typeof window.PUSHER !== 'undefined') {
                console.log('📊 Pusher connection state:', window.PUSHER.connection.state);
                console.log('📊 Pusher connection options:', window.PUSHER.connection.options);
            }
        }

        function refreshPusherSettings() {
            console.log('🔄 Refreshing Pusher settings...');
            // Clear any cached settings and reload
            if (typeof window.PUSHER_SETTINGS !== 'undefined') {
                delete window.PUSHER_SETTINGS;
            }
            if (typeof window.PUSHER !== 'undefined') {
                delete window.PUSHER;
            }
            console.log('✅ Pusher settings cleared, reload page to refresh');
        }

                function disablePusherTemporarily() {
            console.log('🛑 Temporarily disabling Pusher due to quota issues...');
            // Send request to disable Pusher temporarily
            fetch('/api/disable-pusher-temporarily', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                console.log('✅ Pusher disabled, switching to polling...');
                stopPusher();
                if ($wire.get('pollingEnabled')) {
                    startPolling();
                }
            }).catch(err => {
                console.log('❌ Failed to disable Pusher:', err);
            });
        }

        function forceDisconnectAllConnections() {
            console.log('🛑 Force disconnecting all Pusher connections...');

            // Disconnect global Pusher
            if (window.GLOBAL_PUSHER) {
                window.GLOBAL_PUSHER.disconnect();
                console.log('✅ Global Pusher disconnected');
            }

            // Disconnect local Pusher
            if (window.PUSHER) {
                window.PUSHER.disconnect();
                console.log('✅ Local Pusher disconnected');
            }

            // Clear all references
            window.GLOBAL_PUSHER = null;
            window.PUSHER = null;
            pusherChannel = null;

            console.log('🧹 All Pusher connections cleared');
            console.log('💡 Reload the page to reconnect with fresh connections');
        }

                // Listen for Livewire events on document level for new order notifications
                document.addEventListener('livewire:init', () => {
                    console.log('🔧 Setting up new order event listeners...');

                    Livewire.on('newOrderCreated', (data) => {
                        console.log('✅ Livewire event received for new order!', data);
                        // Play sound immediately for new order
                        new Audio("<?php echo e(asset('sound/new_order.wav')); ?>").play();
                        // This ensures the event is caught even if the component listener fails
                    });

                    console.log('🔧 Order component event listeners ready!');
                });

                // Initialize real-time updates
                document.addEventListener('livewire:initialized', () => {
            console.log('🚀 Livewire orders component initialized');
            console.log('📊 Pusher settings check:', {
                pusherSettingsDefined: typeof window.PUSHER_SETTINGS !== 'undefined',
                pusherBroadcastEnabled: typeof window.PUSHER_SETTINGS !== 'undefined' ? window.PUSHER_SETTINGS.is_enabled_pusher_broadcast : 'undefined'
            });

            // Test Pusher connection for debugging
            testPusherConnection();

            // Add manual refresh option for debugging
            window.refreshPusherSettings = refreshPusherSettings;
            window.disablePusherTemporarily = disablePusherTemporarily;
            window.forceDisconnectAllConnections = forceDisconnectAllConnections;
            console.log('🛠️ Debug: Use refreshPusherSettings() in console to clear cached settings');
            console.log('🛠️ Debug: Use disablePusherTemporarily() in console to disable Pusher due to quota issues');
            console.log('🛠️ Debug: Use forceDisconnectAllConnections() in console to force disconnect all connections');

            if (typeof window.PUSHER_SETTINGS !== 'undefined' && window.PUSHER_SETTINGS.is_enabled_pusher_broadcast) {
                console.log('✅ Pusher orders: Using Pusher for real-time updates');
                initializePusher();
            } else {
                console.log('📡 Pusher orders: Using polling for real-time updates');
                console.log('📊 Pusher orders polling settings:', {
                    pollingEnabled: $wire.get('pollingEnabled'),
                    pollingInterval: $wire.get('pollingInterval')
                });
                if ($wire.get('pollingEnabled')) {
                    startPolling();
                }
            }
        });

        // Watch for changes
        $wire.watch('pollingEnabled', (value) => {
            console.log('👀 Orders pollingEnabled changed:', value);
            if (typeof window.PUSHER_SETTINGS !== 'undefined' && !window.PUSHER_SETTINGS.is_enabled_pusher_broadcast) {
                if (value) {
                    console.log('🔄 Orders: Starting polling due to pollingEnabled change');
                    startPolling();
                } else {
                    console.log('🛑 Orders: Stopping polling due to pollingEnabled change');
                    stopPolling();
                }
            } else {
                console.log('📡 Orders: Pusher is enabled, ignoring polling changes');
            }
        });

        $wire.watch('pollingInterval', (value) => {
            console.log('👀 Orders pollingInterval changed:', value);
            if (typeof window.PUSHER_SETTINGS !== 'undefined' && !window.PUSHER_SETTINGS.is_enabled_pusher_broadcast && $wire.get('pollingEnabled')) {
                console.log('🔄 Orders: Restarting polling due to interval change');
                startPolling();
            } else {
                console.log('📡 Orders: Pusher is enabled or polling disabled, ignoring interval change');
            }
        });

        // Cleanup on component destroy
        document.addEventListener('livewire:initialized', () => {
            return () => {
                stopPolling();
                stopPusher();
            };
        });
    </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDeliveryExecutiveContext && $trackingEnabled): ?>
        <?php echo $__env->make('livewire.order.partials.delivery-executive-tracking-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/order/orders.blade.php ENDPATH**/ ?>