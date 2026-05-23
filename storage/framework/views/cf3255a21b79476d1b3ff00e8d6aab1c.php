<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showToggle): ?>
        <?php
            $tooltipId = 'restaurant-open-close-tooltip';
            $tooltipText = $isRestaurantOpen
                ? __('modules.settings.manualToggleCloseTooltip')
                : __('modules.settings.manualToggleOpenTooltip');
            $confirmHeading = $isRestaurantOpen
                ? __('modules.settings.manualToggleConfirmCloseTitle')
                : __('modules.settings.manualToggleConfirmOpenTitle');
            $confirmDetail = $isRestaurantOpen
                ? __('modules.settings.manualToggleConfirmCloseDetail')
                : __('modules.settings.manualToggleConfirmOpenDetail');
            $actionLabel = $isRestaurantOpen
                ? __('modules.settings.manualToggleActionClose')
                : __('modules.settings.manualToggleActionOpen');
        ?>

        <button
            type="button"
            wire:click="openConfirmModal"
            data-tooltip-target="<?php echo e($tooltipId); ?>"
            data-tooltip-placement="bottom"
            class="inline-flex items-center gap-2 px-2 sm:px-3 py-1 text-xs rounded-lg border <?php echo e($isRestaurantOpen ? 'border-green-300 text-green-700 bg-green-50 hover:bg-green-100 dark:border-green-600 dark:text-green-300 dark:bg-green-900/30 dark:hover:bg-green-900/50' : 'border-red-300 text-red-700 bg-red-50 hover:bg-red-100 dark:border-red-600 dark:text-red-300 dark:bg-red-900/30 dark:hover:bg-red-900/50'); ?>"
        >
            <span class="h-2 w-2 rounded-full <?php echo e($isRestaurantOpen ? 'bg-green-500' : 'bg-red-500'); ?>"></span>
            <?php echo e($isRestaurantOpen ? __('app.close') : __('app.open')); ?>

        </button>

        <div id="<?php echo e($tooltipId); ?>" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip max-w-52">
            <?php echo e($tooltipText); ?>

            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <?php if (isset($component)) { $__componentOriginal49bd1c1dd878e22e0fb84faabf295a3f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49bd1c1dd878e22e0fb84faabf295a3f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dialog-modal','data' => ['wire:model.live' => 'showConfirmModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => 'showConfirmModal']); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo e($confirmHeading); ?>

             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    <?php echo e($confirmDetail); ?>

                </p>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['wire:click' => 'closeConfirmModal','wire:loading.attr' => 'disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'closeConfirmModal','wire:loading.attr' => 'disabled']); ?>
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

                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-3','wire:click' => 'toggleRestaurantState','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e($actionLabel); ?>

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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\xamp\htdocs\Hyamii\resources\views/livewire/restaurant/restaurant-open-close-toggle.blade.php ENDPATH**/ ?>