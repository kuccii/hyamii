<div>
    <div
    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
            <h3 class="text-sm font-medium text-gray-700 mb-3 dark:text-gray-400"><?php echo app('translator')->get('modules.dashboard.topTables'); ?> (<?php echo app('translator')->get('app.today'); ?>)
            </h3>
            <ul class="divide-y divide-gray-50 dark:divide-gray-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="py-1 sm:py-2">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                            <div class="flex-1 min-w-0">
                                <div class="w-full max-w-smspace-y-2">
                                    <div >
                                        <div class="flex items-center gap-3">

                                            <span class="text-[11px] text-gray-300 w-4"><?php echo e($loop->index+1); ?></span>

                                            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['w-7 h-7 rounded-lg flex items-center justify-center text-[11px] font-semibold bg-skin-base/[0.2] text-skin-base']); ?>">
                                                <h3 wire:loading.class.delay='opacity-50'
                                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['font-semibold']); ?>">
                                                    <?php echo e($item?->table?->table_code); ?>

                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-[13px] font-medium text-gray-800 dark:text-white">
                                <?php echo e(currency_format($item->total_price, restaurant()->currency_id)); ?>

                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="py-2">
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            <?php echo app('translator')->get('messages.noPaymentFound'); ?>
                        </p>
                    </div>
                    </div>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            </ul>

        </div>
    </div>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/dashboard/today-table-earnings.blade.php ENDPATH**/ ?>