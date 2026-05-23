<div>
    <div>

        <div class="p-4 bg-white block sm:flex items-center justify-between dark:bg-gray-800 dark:border-gray-700">
            <div class="w-full mb-1">
                <div class="mb-4">
                    <h1 class="text-base font-semibold text-gray-900 dark:text-white"><?php echo app('translator')->get('modules.expenses.reports.outstandingPaymentReport'); ?></h1>
                </div>
                <div class="items-center justify-between block sm:flex ">
                    <div class="lg:flex items-center mb-4 sm:mb-0">
                        <form class="sm:pr-3" action="#" method="GET">

                            <div class="lg:flex gap-2 items-center">
                                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['id' => 'dateRangeType','class' => 'block w-fit','wire:model.defer' => 'dateRangeType','wire:change' => 'setDateRange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'dateRangeType','class' => 'block w-fit','wire:model.defer' => 'dateRangeType','wire:change' => 'setDateRange']); ?>
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

                                <div id="date-range-picker" class="flex flex-col w-full gap-2 sm:flex-row">
                                    <div class="relative flex-1">
                                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <?php if (isset($component)) { $__componentOriginal2686ed4927c64f67d2844e9b73af898c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2686ed4927c64f67d2844e9b73af898c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datepicker','data' => ['wire:model.live' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')','class' => 'pl-10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datepicker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'startDate','placeholder' => '@lang(\'app.selectStartDate\')','class' => 'pl-10']); ?>
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
                                    <span class="self-center hidden text-gray-500 sm:block"><?php echo app('translator')->get('app.to'); ?></span>
                                    <div class="relative flex-1">
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
                            </div>
                        </form>
                    </div>

                    <a href="javascript:;" wire:click='exportReport'
                        class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <?php echo app('translator')->get('app.export'); ?>
                    </a>

                </div>
            </div>

        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">

                        <table class="w-full ">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">

                                    <th
                                        class="py-2 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                        <?php echo app('translator')->get('modules.order.payment_due'); ?></th>
                                    <th
                                        class="py-2 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                        <?php echo app('translator')->get('modules.expenses.paymentDueDate'); ?></th>
                                    <th
                                        class="py-2 px-4 text-xs font-medium ltr:text-left rtl:text-right text-gray-500 uppercase dark:text-gray-400">
                                        <?php echo app('translator')->get('modules.expenses.paymentStatus'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700" wire:key='outstanding-payment-list-<?php echo e(microtime()); ?>'>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" wire:key='menu-item-<?php echo e($loop->index . microtime()); ?>' wire:loading.class.delay='opacity-10'>

                                        <td
                                            class="py-2 px-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            <?php echo e(currency_format($expense->amount, restaurant()->currency_id)); ?></td>
                                        <td
                                            class="py-2 px-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            <?php echo e($expense->payment_due_date->format(dateFormat())); ?></td>
                                        <td
                                            class="py-2 px-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded"> <?php echo e($expense->payment_status); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <!-- Total Row -->
                               <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalAmount > 0): ?>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <td class="py-2 px-4 text-xs text-left border-gray-700"></td>
                                        <td class="py-2 px-4 text-xs text-left border-gray-700"><?php echo app('translator')->get('modules.order.total'); ?></td>
                                        <td class="py-2 px-4 text-xs text-left border-gray-700">
                                            <?php echo e(currency_format($totalAmount, restaurant()->currency_id)); ?>

                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">
                                            <?php echo app('translator')->get('modules.expenses.reports.NoReportsFound'); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/reports/outstanding-payment-report.blade.php ENDPATH**/ ?>