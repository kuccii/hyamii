<div class="flex flex-col items-center space-y-4">
    <!-- Call Waiter Button -->
    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'callWaiter','class' => 'inline-flex items-center gap-1 ']); ?>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
    </svg>
        <span><?php echo app('translator')->get('app.callWaiter'); ?></span>
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

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showTableSelection): ?>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 !m-0">
        <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md p-6 text-center relative flex flex-col mx-2 md:m-0 max-h-[40rem] w-full max-w-lg">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4"><?php echo app('translator')->get('modules.table.selectTable'); ?></h2>

            <div class="overflow-y-auto flex-grow">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button wire:click="selectTable(<?php echo e($table->id); ?>)"
                        class="flex items-center justify-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-skin-base hover:text-white hover:border-skin-base transition-colors duration-200 dark:bg-gray-800 dark:text-gray-300">
                        <span class="text-lg font-semibold"><?php echo e($table->table_code); ?></span>
                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                <button wire:click="cancelCall"
                    class="bg-red-500 w-full hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                    <?php echo app('translator')->get('app.cancel'); ?>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <!-- Confirmation Popup -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showConfirmation): ?>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 !m-0">
        <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md p-6 text-center space-y-4">
            <p class="text-gray-700 dark:text-gray-300 text-sm font-semibold"><?php echo app('translator')->get('app.callWaiterConfirmation'); ?> (<?php echo app('translator')->get('modules.table.table'); ?> <?php echo e($table->table_code ?? ''); ?>)</p>
            <div class="flex space-x-4 justify-center">
                <button
                    wire:click="confirmCall"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded"
                >
                    <?php echo app('translator')->get('app.yes'); ?>
                </button>
                <button
                    wire:click="cancelCall"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded"
                >
                    <?php echo app('translator')->get('app.no'); ?>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Notification Message -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notificationSent): ?>
    <div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 !m-0"
>
    <div
        class="bg-green-100 dark:bg-green-900 border border-green-400 text-green-700 dark:text-green-300 px-6 py-4 rounded-lg shadow-lg text-center"
    >
            <?php echo app('translator')->get('app.callWaiterNotification'); ?>
        </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/forms/call-waiter-button.blade.php ENDPATH**/ ?>